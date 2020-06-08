<?php
if ($_SERVER['SERVER_NAME']!=='janmesh.net')
{
	echo '<html><body>We moved to <a href="http://janmesh.net">janmesh.net</a></body></html>';
	die();
 }
?><!DOCTYPE html>
<html>
<head>
<title>Janmesh - Documentation - Linux</title>
 <meta charset="UTF-8"> 
 <style>
 .mainimg{
	 width:40%;
	 margin-left:30%;
	 margin-right:30%;
 }
 body {
	 font-family:sans-serif;
	 margin-left:8%;
	 margin-right:8%;
 }
 div  {
	 font-family:sans-serif;
	 margin-top:3%;
	 margin-left:3%;
	 margin-right:3%;
 }
 code {
	 display:block;
 }
 .topmenu {
	 background-color:grey;
	 padding: 4px;
	 margin-top:2%;
	 }
	 	a {
		text-decoration:none;
	}

 </style>
</head>
<body>
<a href="./">Home</a> > Documentation > Beginner	
<h1>Janmesh - Linux Documentation</h1>
Welcome to the place where things start. Here you'll find beginner documentation, that is to be read before <a href="intermediate.php">intermediate</a> one. 
<br/>

	
<a name="1"/><h2>Tutorial n°1 : How to deploy a local Janmesh network between two computers from nothing :</h2>

This tutorial has beeen updated and now is adapted to use with Ubuntu 18.04.
<h3>Objectives of this tutorial</h3>
The point of this tutorial is to inter-connect computers throught a  wifi network, and to add a olsrd routing, plus an encryption and authentication layer with cjdns. It will make these machines a part of the Janmesh meshlocal.
<br/>
<h4>The addressing</h4>
We will use link-local addresses. It's sufficient for the scale of most urban areas, because this methode allows about 65000 addresses, and most of the time one household will only need one address.
<br/>
As a matter of fact inter-connecting different network segments will need two dedicated interfaces, for example to operate long-range liaison, connecting two network segments with each their 65 000 available addresses.<br/>
<h5>On the scale of a city</h5>
On the scale of a big city, it would be more complicated : we can cut the network into segments by neighbourhood or district, and every segment must have its own essid because the wifi coverage of the segments will be overlapping each other.
<br/>
For example : append "Lyon 1er", "Lyon 2eme", "Lyon 3eme" to the essid for the areas of the city of Lyon.<br/>
Remenber that the wifi network is just a layer, and Janmesh acually uses cjdns, wich is a higher layer protocol, that uses the wider range of addresses of the IPV6 protocol to route packets between machines.<br/> 
<h3>Step 0 : install required software</h3>
For each computer enter the command line (need an internet access) : 
<code>$ sudo apt-get install olsrd ufw</code><br/>
This will install the olsrd dynamic routing and the firewall manager ufw.
	
<h3>Step 1 : Mesh setup</h3>

<h4>Step 1.1 : create the wifi network</h4>
<br/>

<h3>Setting up a network connection using network manager</h3>
<code>$ nmcli connection add con-name janmesh ipv4.method link-local ipv6.method auto  autoconnect yes type wifi ifname wlan0 mode adhoc ssid http://janmesh.net<br/>
</code>
<br/>
<br/>
<br/>
	
<h4>Step 1.2 : Activate olsrd dynamic routing</h4>
olrsd will allows every packet passing throught the wifi network to take the better route, from computer to computer.<br/>
Change the olsrd configuration file, /etc/olsrd.conf : <br/>
<code>$ sudo nano /etc/olsrd.conf</code>
Add a section
<code>
Interface "wlan0" {<br/>
	Ip4Broadcast 255.255.255.255<br/>
}
</code>
(The name of your wifi interface will probably be "wlan0", but it can be different. For example on our lab-testing machine "durandal" it was called wlan5. You can use iwconfig to know the name of your wifi interface if you're not sur of its name (should be wlan-something)).<br/>
Then launch the olsrd daemon in background : <br/>
<code>
$ sudo olsrd
</code>
	
<h3>Step : installation and configuration of cjdns</h3>
<h4>Cjdns installation</h4>
Before anything, we need to install git to download the cjdns's source, that we will compile next. <br/>
<code>
$ sudo apt-get install git<br/>
</code>
Download, compile and install cjdns :<br/>
<code>
$ cd /opt<br/>
$ sudo git clone https://github.com/cjdelisle/cjdns.git<br/>
$ cd cjdns<br/>
$ sudo ./do<br/>
$ sudo ln -s /opt/cjdns/cjdroute /usr/bin<br/>
$ sudo su <br/>
# (umask 077 &amp;&amp; ./cjdroute --genconf > /etc/cjdroute.conf)<br/>
# exit <br/>
</code>
Then launch cjdns with <code>$ sudo cjdroute &lt; /etc/cjdroute.conf</code><br/>
<h3>Step 3 : block any non-cjdns traffic and open the wifi</h3>
We will have to, for each machines, search into the congiguration file of cjdns which port it's using. you can open this file with the command :
<code>sudo nano /etc/cjdroute.conf</code>
The port number is on the line :
<code>
"your.external.ip.goes.here:65011": {<br/>
</code>
In this case, it will be 65011. The number is randomly generated and won't be the same on your hardware. Write it down, we will need it !<br/>
We want here to block all the trafic on the wifi interface used by the mesh, except for the cjdns's port (65011 in this case).
This number in the next lines should be adjust with your cjdns port number.<br/>
The name of the wifi interface should be wlan0. If it's not, you can have the actual name with the command <code>iwconfig</code>
<code>
$ sudo ufw enable<br/>
$ sudo ufw deny in on wlan0<br/>
$ sudo ufw allow in on wlan0 to any port 65011<br/>
$ sudo ufw deny out on wlan0<br/>
$ sudo ufw allow out on wlan0 from any port 65011<br/>
</code>
	
	
<h3>Configure a script to make the changes permanent</h3>
Note : this method will use upstart, it's the default services management system in Ubuntu 14.04. But(For the long term supported versions), systemd is the default services manager since Ubuntu 16.04, it's better to use it. THIS SECTION HAS THEN TO BE UPDATED. Nevertheless Ubuntu 18.04 still supports upstart, then the code provided remains useful.</br>
Into the folder /etc/init.d, create a text file nammed janmesh : 
<code>
$ gksu gedit /etc/init.d/janmesh
</code>
And copy in it what follows :
<pre style="border: solid 1px;">
#!/bin/sh<br/>
case $1 in <br/>
	 start)<br/>
		/usr/bin/nmcli con up id janmesh;<br/>
		/usr/bin/cjdroute &lt; /etc/cjdroute.conf;<br/>
		/usr/sbin/olsrd;;<br/>
		
	 stop)<br/>
		/usr/bin/killall cjdroute;
		/usr/bin/nmcli conn down id janmesh;
		/usr/bin/killall olsrd;;<br/>
		
esac
</pre>
save and close.<br/>

In Ubuntu 16.04 and newer: you have to make the script executable : 
<br/>
<code>$ sudo chmod +x /etc/init.d/janmesh</code><br/>
<br/>

You can now start or stop the janmesh connexion with :
<code>
$ sudo /etc/init.d/janmesh start
</code>
and
<code>
$ sudo /etc/init.d/janmesh stop
</code>
<br/>


The last step is to launch Janmesh at startup - be careful, if the only connection of your machine is Janmesh and your machine can only be remotely control, this step is essential, because we blocked all the trafic except the Janmesh (cjdns, higher CoOoOw stack level) one. You <strong>have</strong> to do so to get connectivity upon reboots later! <br/>
<code>
$ sudo update-rc.d janmesh defaults
</code>

<h2>And finally</h2>
<div style="border: solid black 1px">
<h2>HOWTO Prevent some services to be accessed on your computer, prevent them to be accessible throught Janmesh</h2>
<h3>Blocking a single port</h3>
If you wish to block only one particular service. 
Exemple for a mesh with one tun0 mesh interface up, on which we want to block access to a listening web server (port 80) :<br/>
$ sudo ufw deny in on tun0 to any port 80 
<h3>Whitelisting only wished open services and blocking anything else</h3>
A much more secure approach is to block anything and allow only what is useful. Example if you want to allow a listening web server (port 80) and block anything else, for a mesh network operating on the tun0 interface:
<code>
$ sudo ufw allow in on tun0 to any port 80<br/>
$ sudo ufw deny in on tun0<br/>
</code>
</div>

<hr/>
Licensing: this tutorial is placed under two licenses. Code is placed under <a href="https://www.gnu.org/licenses/agpl-3.0.txt">AGPLv3</a> license. Other text content here is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0">Creative Commons BY-SA 4.0 license</a>. Authors are : Shangri-l. Translators are : Nomys. Translation proofreader are : Shangri-l
</body>
</html>
