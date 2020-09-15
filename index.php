<?php
if ($_SERVER['SERVER_NAME']!=='janmesh.net')
{
	echo '<html><body>We moved to <a href="http://janmesh.net">janmesh.net</a></body></html>';
	die();
 }
?><!DOCTYPE html>
<html>
<head>
<title>Janmesh - Shaping the networks</title>
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
	 text-align:left;
 }
 div  {
	 font-family:sans-serif;
	 margin-top:3%;
	 margin-left:3%;
	 margin-right:3%;
 }
 .topmenu {
	 background-color:grey;
	 margin-top:2%;
	padding: 4px;
	 }
	 	a {
		text-decoration:none;
	}

 </style>
</head>
<body>
	<div style="width:100%;border: solid black 3px; border-radius: 8px;font-size:84%;">
	<em>Need support?</em> To help people setting up mesh stations, Janmesh community now provides support, covering all the steps of a neighbour-to-neighbour network creation, from OS installation to configuration and update, including CoOoOw stack deployment. Send support inquiries to <a href="mailto:janmesh@janmesh.net">janmesh@janmesh.net</a><br/><span style="font-size:78%;">You can also join the IRC live chat ; #janmesh channel on Freenode IRC network namely. If you don't get what all this mean, use <a target="new" href="https://kiwiirc.com/nextclient/irc.freenode.net/#janmesh">this webchat link</a> to get into the live chat chatroom</span>
	
	</div>
<span style="text-align:center;">
<h1>Janmesh.net</h1>
<h3>Joint Access Mesh Networks</h3>
</span>
<div style="background-color:blue;color:white;border: solid black 3px;border-radius:8px;">
<a style="border:solid yellow 3px; border-radius:12px;color:white;padding:3px" href="./">Home</a>
<a style="border:solid yellow 3px; border-radius:12px;color:white;padding:3px" href="#intro">Intro</a>
<a style="border:solid yellow 3px; border-radius:12px;color:white;padding:3px" href="#doc">Doc</a>
<a style="border:solid yellow 3px; border-radius:12px;color:white;padding:3px" href="#faq">FAQ</a>
<a style="border:solid yellow 3px; border-radius:12px;color:white;padding:3px" href="#about">About&nbsp;us</a>





</div>
<h1 style="text-align=center;">Cell phones without carrier operators... An internet run and owned by citizen... Host your web service/application brick at home or on the go in your device and say goodbye to centralized intermediates... Is this feasable ? Sure !</h1>
<a name="intro"><h2>What is Janmesh?</h2></a>
<strong>Janmesh</strong> is a citizen-to-citizen networking initiative, that provides an alternative communication medium resistant to severely disruptive situations. <br/>
<div style="float;right;">
	
	<h2>Janmesh...</h2>
	The <em>Janmesh</em> network (SSID: http://janmesh.net ) uses a  <strong>CoOoOW</strong> stack (<em>cjdns</em> over <em>OLSRD</em> over open WiFi).
	<h2>What it does: </h2>
	It's a network layer deployed over both the internet, and both wifi mesh local networks, which grows and extends range as new station are joigning the mesh. It then provide a virtual network, and all the participant are just like if their where all on the same local lan. Accessing a machine at the other side of the town, or of the world, is as easy as access your home printer on your home lan.       
	<h2>What are the benefits?</h2>
	Such a network is highly resistant to censorship and to severely disruptive situation like disasters or civil wars, allowing to maintain citizen-operated networking service even if internet is down, and to still provide untakedownable, acentered/distributed system of internet-based communication tools and various services. 
	<h2>What do we need ?</h2>
	<ol><li>Linux/Unix-based computing units with ad-hoc wifi able to run olsrd and cjdns : <strong>As of 2020, they have been here for more than one decade</strong></li>
	<li>Phones finally allowing ad-hoc wifi (typically Linux phones) and olrsd/cjdns : <strong>As of 2020, they are hitting the market</strong></li></ol>
	
<h2>Where are we now ? </h2>
Althought running Janmesh on a phone is quite adventurous and may require tweaking, running Janmesh on a linux device or computer, from neighbour to neighbour, using wifi or whatever else, is quite easy. To sum up, land stations are absolutely ready, and mobile stations are already here at some point. 
	<h2>Janmesh box</h2>
A <strong><em>Janmesh box</em></strong> is a device that operates the mesh wifi network and that is plugged into your home lan internet box. It can instantly start peering with a neighbour at wifi range, immediately connect any cjdns-enabled home lan machine to the join acces mesh network, and is likely to provide, or can be easily set to provide, an internet-tunneled peering with a public peering server, unifiying then networks at the whole world level. 
<br/>
It is typically built from an old wifi modem-router, or an unexpensive SystemOnChip xtra small form factore computing device, or even an old laptop or simply any computer with at least one available extra wifi interface. 

<a name="doc"><h2>How is the Janmesh Project doing?</h2></a>
A full documentation to get a working CoOoOW stack with basic Ubuntu GNU/Linux computers is available. The network is up and runing at a local scale<br>
<h2>Documentation and tutorials</h2>
<h3>Janmesh Box (using an old modem/router)</h3>
Learn how to flash an old modem/router with OpenWRT and turn it into <a href="./router.php">a mesh wifi CoOoOw station, wifi network client and range extender, and local-lan ethernet autopeerer for Janmesh/CoOoOw (Janmesh V1) networks</a><hr/>


<h3>Janmesh box (using an Ubuntu Linux device or computer)</h3>
Read how to, using wifi links and a CoOoOw stack, from scratch, setup the mesh network. Then, learn more about firefalls to secure (network) access to your devices.  <a href="index-main.php">-Read more-</a>.
<hr/><br/>
<h3>Internet sharing (between two Linux/UNIX devices or other OSes with adaptations)</h3>
Lear how to use one machine that operate Janmesh over Wifi and that is connected to Internet through Ethernet to act as a gateway and NAT box in order to allow other devices with (meshing) wifi only to share its Internet access.  <a href="intermediate.php">-Read more -</a>
<!--<hr/><a name="ocsad"><h3>Ocsad</h3></a>
Ocsad (Open cjdns services announcement and discovery) is a GUI cross-platform services discovery and announcement tool, allowing to publicly get your open-to-use services you made available on your machine listed and discoverable by other users, and allowing you to discover, manage, at access services from your favorite people. Currently in "planned" stage, you can <a href="https://github.com/janmeshnet/janmesh.net">participate</a> to the design proposals and discover them <a href="./ocsad">on the Ocsad page</a>. 
<a name="javica"><h3>Javica</h3></a>
Javica is a php web application aimed at run on a network of http servers. It provides a basic framework to allow developpers to setup more complex operation involving known "contacts" and the cjdns network. <a href="https://github.com/janmeshnet/javica">Code repo</a>. 
</div>-->
<hr/>
<a name="faq"><h2 style="clear:both;">And now learn more about citizen-to-citizen networking future...</h2></a>
<hr/>
The base: <em>The connectivity to the mesh network can ben tunneled through a long-range directionnal radio link to connect distant communities</em><br/>
<strong>Or tunneled over Internet -or any other network medium- to rely distant places of the world</strong><hr/>
<h3>Frequently asked questions</h3>
<h3>Linphone</h3>
With Linphone you can pass audio and video calls over Cjdns, just knowing the IPv6 (Cjdns Address) of the people you want to call. 
<h3>What can I do with a Janmesh in my neighbourhood already? Do I have to wait for further developments to make something useful?</h3>
In short, you don't have to wait. If you have physical or remote access to your Janmesh node station, you can just use out-of-the-box any network services such as SCP, HTTP or SFTP/FTP file transfer or just any other common protocol, with the requirement that you'll have to know the IPv6 adress of the machine you'll want to talk to, and that the protocol supports IPv6 adressing (some protocols require hostnames and are then not suitable). 
<h3>Is Janmesh using only radio link? Can I use some other kind of networking medium? </h3>
You can use any networking medium to setup and operate your CoOoOw stack. You can use an ethernet cable to connect with a close neighbour, as well as associated BPL interfaces to connect with other homes using the same electrical power transformator than you (typically, your block and nearest ones). 
<a name="about"><h3>Why Janmesh? Why spend your sweat and energy to propel the whole project?</h3></a>
I (<em>Shangri-l</em>) am not sure. I'm having fun with experimenting neighbourhood networking since the early 2000's. I just cannot prevent myself to stop. I was hoping my close neighbours would read all this and mesh with me, to aae share files or text messages or build whatever useful. This hasn't happened yet. That's the bad side of network effect. But if a few people start to join Janmesh, it will become more attractive, and the more people will use it, the more people will use it. That's the good side of network effect. 
<hr style="margin-top:100%;"/>
</body>
</html>
