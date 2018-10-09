<?php
if ($_SERVER['SERVER_NAME']!=='janmesh.net')
{
	echo '<html><body>We moved to <a href="http://janmesh.net">janmesh.net</a></body></html>';
	die();
 }
?><!DOCTYPE html>
<html>
<head>
<title>Janmesh - Documentation Linux</title>
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
<a href="./">Home</a> &gt; Documentation &gt; intermediate

<h1>Janmesh - Linux Documentation</h1>
Make sure you read <a href="./index-main.php">beginner</a> documentation to know what we'll talk about here. 
<h2>Intermediate tutorial n°1: Share the internet connexion with a computer that is only connected to Janmesh</h2>

<br/>

<strong>Voodoo computing warning</strong>
The author of this tutorial achieved to make things work but does not fully understand how or why. Use at your own risk. <hr/>
Basics<br/>
We got two Janmesh nodes, connected together through CoOoOw mesh-local wifi. Both got the /etc/init.d/janmesh script installled. If you're not sure to know what this mean, please refer to the <a href="index-main.php">beginner's</a> tutorials. 
<br/>
One station is the "client", whishing to have internet access. The other station has internet access through Ethernet (eth0) and whishes to share this access with the client.<br/>
The first thing to edit is the two /etc/cjdroute.conf files on each computer. <br/>
<br/><code>$ sudo nano /etc/cjdroute.conf</code><br/>
Locate in this file the "publicKey" for each one. We'll need them. <br/>
<br/>
On the gateway, look at the output of the <pre>ifconfig</pre> command and take note of the "adr inet6" given for the "eth0" interface.<br/>
We want the adress of the form 111:1111:1111:1111:1111:1111 and NOT the "/64" or whatever mask (number) is used.  
<br>
then on the gateway, give credential to the client, by editing gateway's cjdroute.conf this way:<br/>
in the section "router &gt; iptunnel &gt; allowedConnection" edit the section this way
<pre>
//  It's ok to only specify one address.
                 {      //anduril access
                     "publicKey": "herepastethePublicKeyoftheclient.k",
                     "ip6Address": "1111:1111:1111:1111:1111:1111:1111",
                     "ip6Prefix": 0,
                     "ip4Address": "10.0.0.4",
                     "ip4Prefix": 0
                 }

</pre>
As you can see, you have to edit "publicKey" and "ip6Address" with the numbers that you were asked to keep at hand previously. 
<hr/>
Then on the client, indicate that we want to link with the gateway: <br/>
in the section "router &gt; iptunnel &gt; outgoingConnections", on a new line, add the following: <br/>
<pre>
"herepastethePublicKeyofthegateway.k"
</pre>
With the public key of the gateway that you got previously. 
<hr/>
Then we gonna edit the /etc/init.d/janmesh startup scripts on both machines to set the correct routing and adresses upon start of the Janmesh service.<br/>
1111:1111:1111:1111:1111:1111:1111 still refer to the adress you took note of previously. <br/>
On the gateway: 
<pre style="border: solid black 1px">
#!/bin/sh
case $1 in 
         start)
                /usr/bin/nmcli con up id janmesh;
                /usr/bin/cjdroute &lt; /etc/cjdroute.conf;
                /usr/sbin/olsrd;
                ip -6 addr ad dev tun0 1111:1111:1111:1111:1111:1111/64
                ip addr add dev tun0 10.0.0.1/24;
                ip route add 10.0.0.0/24 dev tun0;
                ip -6 route add dev eth0 1111:1111:1111:1111:1111:1111:1;
                ip -6 route add dev tun0 1111:1111:1111:1111:1111:1111/64;
                ip -6 route add default via 1111:1111:1111:1111:1111:1111;
                iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE;
                iptables -A FORWARD -i eth0 -o tun0 -m state --state RELATED,ESTABLISHED -j ACCEPT;
                iptables -A FORWARD -i tun0 -o eth0 -j ACCEPT;;

         stop)
                /usr/bin/killall cjdroute;
                /usr/bin/killall olsrd;;
				/usr/bin/nmcli conn down janmesh
esac
</pre>
<strong>NOTE THE TRAILING ":1" </strong>on the line <code>ip -6 route add dev eth0 1111:1111:1111:1111:1111:1111:1;</code></strong>
<br/>
And on the client: 
<pre style="border: solid black 1px">
#!/bin/sh
case $1 in 
         start)
                /usr/bin/nmcli con up id janmesh;
                /usr/bin/cjdroute &lt; /etc/cjdroute.conf;
                /usr/sbin/olsrd;
                sleep 25;
                ip route add 10.0.0.0/24 via 10.0.0.4;
                ip route add default via 10.0.0.4;;
         stop)
                /usr/bin/killall cjdroute;
                /usr/bin/killall olsrd;;
				/usr/bin/nmcli conn down janmesh
esac
</pre>
<h3>DNS configuration</h3>
You'll have to know the IPv4 adress of your home modem/router (box provided by your ISP), which could be, say, 192.168.1.1, 192.168.1.254, or whatever ! Good luck (or alternatively you can make use of any other online public DNS server's IP address). Indicate it by editing <pre>/etc/resolvconf/resolv.conf.d/tail</pre> this way: <br/> 
<code style="border:solid 1px black">
nameserver 192.168.1.254


</code>
<br/>
replace the dot-separated numbers with the actual address of your internet box. <br/><hr/>
You're done. Once Janmesh service relaunched on both computing devices, you should be able to ping google.com or whatever from the client, starting from now. <br/>
The "sleep 25" seems mandatory, since adresses not associate instantly when the network is brought up. If you got an error message when running <code>/etc/init.d/janmesh start</code>on the client, wait for one second or two and retry, generally it's enough. <br/>
Licensing: this tutorial is placed under two licenses. Code is placed under <a href="https://www.gnu.org/licenses/agpl-3.0.txt">AGPLv3</a> license. Other text content here is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0">Creative Commons BY-SA 4.0 license</a>. Authors are : Shangri-l
</body>
</html>
