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
<h2>Tutorial n°5 : Prevent some services to be accessed on your computer, prevent them to be accessible throught Janmesh</h2>
<h3>Blocking a single port</h3>
If you wish to block only one particular service. 
Exemple for a mesh with one tun0 mesh interface up, on which we want to block access to a listening web server (port 80) :<br/>
$ sudo ufw deny in on tun0 to any port 80 
<h3>Whitelisting only wished open services and blocking anything else</h3>
A much more secure approach is to block anything and allow only what is useful. Example if you want to allow a listening web server (port 80) and block anything else, for a mesh network operating on the tun0 interface:
<code>
$ sudo ufw deny in on tun0<br/>
$ sudo ufw allow in on tun0 to any port 80<br/>
</code>
<h2>Tutorial n°4: Share the internet connexion with a computer that is only connected to Janmesh:</h2><br/>
<br/>This can now be found in the <a href="./intermediate.php">intermediate</a> documentation section<br/>
<br/>
<br/>
<h2> Tutorial n°3 : Add a computer to an existing Janmesh network with command lines :</h2><br/>
<br/>
If you read the tutorial number 1, you won't have any issues to understand the command lines to add an another computer to a Janmesh network :<br/>
<br/>
<br/>
<h3>Setting up a network connection using network manager</h3>
$ nmcli connection add con-name janmesh autoconnect yes type wifi ifname wlan0 mode adhoc ssid http://janmesh.net<br/>
<br/>
<br/>
$ nmtui edit janmesh<br/>
 -> ipV4 -> link-local ; -> ipv6 -> automatic <br/>
<br/>
$ nmcli con up id janmesh<br/>
<br/>

<h3>Olsrd and cjdns</h3>
$ sudo apt-get install olsrd<br/>
<br/>
$ sudo nano /etc/olsrd/olsrd.conf<br/>
<br/>
-> add a section<br/>
<br/>
Interface "wlan0" {<br/>
Ip4Broadcast 255.255.255.255<br/>
} <br/>
<br/>
$ sudo olsrd<br/>
<br/>
$ sudo apt-get install git<br/>
<br/>
Then download, compile and install cjdns :<br/>
<br/>
$ cd /opt<br/>
$ sudo git clone https://github.com/cjdelisle/cjdns.git<br/>
$ cd cjdns<br/>
$ sudo ./do<br/>
$ sudo ln -s /opt/cjdns/cjdroute /usr/bin<br/>
$ sudo su<br/>
# (umask 077 && ./cjdroute --genconf > /etc/cjdroute.conf)<br/>
<br/>
<br/>
Launch cjdns with the command :<br/>
# cjdroute < /etc/cjdroute.conf <br/>
(In Ubuntu 16.04 : this will not work with sudo, you have to be in sudo su)<br/>
# exit<br/>
<br/>
Write down the port number following "your.external.ip.goes.here:" in /etc/cjdroute.conf<br/>
<em>in this example it is 65011, replace it with your written down port number</em>
<br/>
$ sudo ufw enable<br/>
$ sudo ufw deny in on wlan0<br/>
$ sudo ufw allow in on wlan0 to any port 65011<br/>
$ sudo ufw deny out on wlan0<br/>
$ sudo ufw allow out on wlan0 from any port 65011<br/>
<br/>
$ nmcli con up id janmesh<br/>
<br/>
$ sudo nano /etc/init.d/janmesh<br/>
...then copy the script code provided in step 6 of the "GUI installation" tutorial that you can find below.<br/>
<br/>
In Ubuntu 16.04 and newer: you have to make the script executable : 
<br/>
$ sudo chmod +x /etc/init.d/janmesh<br/>
<br/>
$ sudo update-rc.d janmesh defaults

<a name="2"/><h2>Tutorial n°2 : Configure a computer to be a meshbox linked to an existing Janmesh network and share its connection to another machine : </h2>
The point of this tutorial is to configure a machine to be a pure meshbox, connected with a pre-existing Janmesh network in range.<br/>
Need to be completed
	
<a name="1"/><h2>Tutorial n°1 : How to deploy a local Janmesh network between two computers from nothing :</h2>

Computers were under Ubuntu 14.04. It is still tested also with 16.04 and working as well with the small neeeded changes indicated in the tuto. For 18.04, there are things to tweak, but everything is explained below<br/>

<h3>Objectives of this tutorial</h3>
The point of this tutorial is to inter-connect two computers throught a new wifi network, and to add a olsrd routing, plus an encryption and authentication layer with cjdns. It will make these machines a part of the Janmesh meshlocal.
<br/>
<h4>The adressing</h4>
We will use link-local adresses. It's sufficient for the scale of most urban areas, because this methode allows about 65000 adresses, and most of the time one household will only need one adress.
<br/>
As a matter of fact inter-connecting different network segments will need two dedicated interfaces, for example to operate long-range liaison, connecting two network segments with each theirs 65 000 available adresses.<br/>
<h5>On the scale of a city</h5>
On the scale of a big city, it would be more complicated : we can cut the network into segments by neighbourhood or district, and every segment must have its own essid because the wifi coverage of the segments will be overlapping each other.
<br/>
For example : append "Lyon 1er", "Lyon 2eme", "Lyon 3eme" to the essid for the areas of the city of Lyon.<br/>
Remenber that the wifi network is just a layer, and Janmesh acually uses cjdns, wich is a higher layer protocol, that uses the wider range of adresses of the IPV6 protocol to route packets between machines.<br/> 
<h3>Computers used for the initial deployment</h3>
<h4>Machine 1</h4>

Host's name : durandal.local<br/>
Network interfaces : 1 wifi b/g/n (to operate the local mesh)<br/>
Note : this machine will get access to a home private network only, since it has got only one network interface, which is used by the mesh network. So to get internet it would have to be propelled throught a shared connexion provided by anduril.local.<br/>
battery-powered : Yes<br/>

<h4>Machine 2</h4>

Host's name : anduril.local<br/>
Network interfaces : 1 wifi b/g/n (to operate the local mesh) ; 1 ethernet access to the home private network and internet<br/>
Note : this computer will share its home network access and internet access to durandal.local.<br/>
Battery-powered  : No<br/>

<h3>Step 0 : install softwares requiered</h3>
For each computer enter the command line (need an internet access) : 
<code>$ sudo apt-get install olsrd gufw</code><br/>
This will install the olsrd dynamic routing and the firewall manager gufw.
	
<h3>Step 1 : inter-connecting anduril and durandal</h3>

Before anything else, let's put a logical name to our machines. Modern systems can handle host name with domain .local, it will be ashame to not use it. For machines I'm running, I chose sword's names. Every user of the local, home network should use names from a unique lexical field (in this case, swords) to avoid	duplicates hostname in the local network. Note that since broadcast messages cannot be spread thru the tun0 (cjdns) virtual network interface, names collision inside the mesh itself are not an issue. <br/>

For example, on durandal.local : <br/>

<code>$ sudo unity-control-center</code>

(sudo will ask your password)<br/>

Then in the first tab of the section "about this computer", change the host name to "durandal"

<hr/>

Therefore, on durandal and on anduril <br/>

<h4>Step 1.1 : create the wifi network</h4>
<br/>
** This section works for Ubuntu 16.04 but is obsolete in the next LTS (18.04 version) **
** if you are running Ubuntu 18.04 please refer to "Setting up a connection using network manager" in the Tutorial 3 above, which explain how to do exactly the same thing but using command line **
Right clic on the network icone in the notification bar -> connexions's modifications<br/>
Wifi tab -> new<br/>
Connexion name -> janmesh<br/>
General tab -> allow acces to any user of the systme, and allow the connection to connect automatically whenever it's available<br/>
Wifi tab -> ad hoc mode, essid http://janmesh.net<br/>
Wifi Security tab -> personnal wpa -> enter the password of your choice. It will only be used for the network configuration, then the wifi will be open because encryption and authentification will be handle by cjdns.<br/>
Ipv4 tab -> method : local-link only<br/> 
Ipv6 tab -> auto<br/> 
Validate<br/>
In a command prompt enter :<br/>
<code>$ nmcli con up id janmesh</code>
**end of the obsolete section**
<br/>
Once this done on the two computers, you can test the connexion between then with the command (from durandal) :
<br/>
<code>$ ping anduril.local</code><br/>
Note there can be a bit of delay for the host name anduril.local propagation to be effective. 
	
<h4>Step 1.2 : Activate olsrd dynamic routing</h4>
olrsd will allows every packet passing throught the wifi network to take the better route, from computer to computer.<br/>
Change the olsrd configuration file, /etc/olsrd.conf : <br/>
<code>$ gksu gedit /etc/olsrd.conf</code>
Add a section
<code>
Interface "wlan0" {<br/>
	Ip4Broadcast 255.255.255.255<br/>
}
</code>
(The name of your wifi interface will probably be "wlan0", but it can be different. For example on durandal it is called wlan5. You can use iwconfig to know the name of your wifi interface if you're not sur of its name (should be wlan-something).<br/>
Then launch the olsrd daemon in background : <br/>
<code>
$ sudo olsrd
</code>
	
<h3>Step 2 : install and configuration of cjdns on every computers</h3>
Need to be completed<br/>
<h4>Cjdns installation</h4>
On anduril : <br/>
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
Finally, to allow durandal to download cjdns from anduril, you need to install ssh on anduril :
<code>
$ sudo apt-get install ssh<br/>
</code>
On durandal : <br/>
Durandal only have connectivity to the Janmesh, and no internet, so it can't download cjdns from internet. We have to get it from anduril :<br/>
<code>
$ cd /usr/bin<br/>
$ sudo sftp &lt;username on durandal&gt;@anduril.local:/usr/bin/cjdroute<br/>
</code>
Then generate the configuration file with :
<code>
$ sudo su <br/>
# (umask 077 &amp;&amp; ./cjdroute --genconf > /etc/cjdroute.conf)<br/>
# exit <br/>
</code>
Launch now cjdns with : <code>$ sudo cjdroute &lt; /etc/cjdroute.conf</code><br/>


<h3>Step 3 : block any non-cjdns traffic and open the wifi</h3>
We will have to, for each machines, search into the congiguration file of cjdns which port it's using. you can open this file with the command :
<code>gksu gedit /etc/cjdroute.conf</code>
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
How to open the wifi network :<br/>
In the network manager, edit the "Janmesh" connexion, and replace "security: WPA" by "security: open".
<h4>Why do I have to open the wifi? </h4>
Any traffic will be blocked outside Cjdns (65011 port) communications. That's what we just did in the previous step. <br/>
Cjdns will operate at the higher level of the CoOoOw stack a consistent, virtual IPv6 network, fully encrypted. <br/>
Then encryption at lower levels is neither needed nor wishable. <br/>
Especially, sharing one passphrase with neighbours to allow them to join the wifi layer of the stack is counterproductive - and useless, since Cjdns will take care of encryption. <br/>
You <em>don't definitively</em> want to have to share a passphrase for the wifi layer. If you don't, people can join the Janmesh without requiring additional configuration step and the range of the network will seamlessly extend. <br/>	
<h3>Step 5 : share the home private network and the internet network from anduril to durandal</h3>
See the "<a href="./intermediate.php">Intermediate</a>" section of this site. 
	
<h3>Step 6 : configure a script to make the changes permanent</h3>
Note : this method will use upstart, it's the default services management system in Ubuntu 14.04. (For the long term supported versions), systemd is the default services manager since Ubuntu 16.04, it's better to use it.</br>
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
You can now start or stop the janmesh connexion with :
<code>
$ sudo /etc/init.d/janmesh start
</code>
and
<code>
$ sudo /etc/init.d/janmesh stop
</code>
<br/>
In Ubuntu 16.04 and newer: you have to make the script executable : 
<br/>
$ sudo chmod +x /etc/init.d/janmesh<br/>
<br/>


The last step is to launch Janmesh at startup - be careful, if the only connection of your machine is Janmesh and your machine can only be remotely control, this step is essential, because we blocked all the trafic except the Janmesh (cjdns, higher CoOoOw stack level) one. You <strong>have</strong> to do so to get connectivity upon reboots later! <br/>
<code>
$ sudo update-rc.d janmesh defaults
</code>
<hr/>
Licensing: this tutorial is placed under two licenses. Code is placed under <a href="https://www.gnu.org/licenses/agpl-3.0.txt">AGPLv3</a> license. Other text content here is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0">Creative Commons BY-SA 4.0 license</a>. Authors are : Shangri-l. Translators are : Nomys. Translation proofreader are : Shangri-l
</body>
</html>
