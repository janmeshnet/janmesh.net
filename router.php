<!DOCTYPE html/>
<html>
<title>Janmesh - Documentation - Build a meshbow out from an old modem-router</title>
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
<a href="./">Janmesh.net</a> &gt; Documentation - How to turn an old modem router into a Janmesh wifi repeater
<h1>Turn an old modem router into a Janmesh wifi repeater and cjdns connectivity hub</h1>
Maybe you've got one useless old modem/router that can be used to connect to internet. Here, will convert one of them, namely a DLink dsl 2740B, into a dumb wifi access point (AP) that will operate open ad-hoc wifi, olsrd, and cjdns, in order to extend the range of a Janmesh network, and will distribute the mesh connectivity to the whole home lan network, simply by being pluggued through ethernet in your home Internet Box. 
<h2>Find the right firmware for flashing</h2>
First off we head on to <a href="https://openwrt.org/toh/d-link/dsl-2740b" target="new">https://openwrt.org/toh/d-link/dsl-2740b</a>. The sticker at the rear of the router says "hw version : F1" which is supported by OpenWRT up to version 19.07.2. Then we can 
<br/>
<br/>	Download the flash image. 
    <br/> Press and hold the reset button
    <br/> Power on the device
  <br/>  Wait until the power LED turns solid (after about 30 seconds)
 <br/>   Browse to http://192.168.1.1/
 <br/>   Login as admin, password admin
   <br/> Maintenance -> firmware update
    <br/> Upload the image 
<br/>
<h2>Basic configuration</h2>
If you get into serious trouble, remember that you can always use the reset button and restart from here. <br/>

log in at http://192.168.1.1 , as root,  with empty password, and set a new password. Edit the wireless (network) : select Add then<br/> 
Mode: Ad-Hoc<br/>
SSID: http://janmesh.net<br/>
add "lan" to networks associated  with this interface<br/>
<br/>
Tip: You may want to prevent low ACK disconnect in the 'advanced' tab. 
<br/>
apply pending changes and enable wifi interface
<hr/>
We now want to integrate the DLink into the lan infrastructure in order to have it able to reach internet. Most lan networks have a DHCP server running that can configure connections for a new network device. 
<br/>
All we have to do is to set up the ethernet interface to act as a DHCP client : 
<br/><br/>
Network->interfaces, edit lan, set DHCP Client instead of Static Adress in "Protocol", apply pending changes<br/><br/>
Locate by scan or in your main modem-router (box) admin panel the newly DHCP-assigned new ip adress of the dlink, and point your browser to it. <br/><br/> 
Network diagnostics should now ping. 
<hr/>
System->software-Update list, then install olsrd and cjdns packages
<br/>
You now got a Janmesh range extender, ethernet autopeerer box, fully fonctionnal. 

</body>


</html>
