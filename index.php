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
<h2>What is Janmesh? What is a Janmesh box? </h2>
<strong>Janmesh</strong> (SSID http://janmesh.net) is a citizen-to-citizen networking initiative, running nodes with an active <strong>CoOoOW</strong> stack (<em>cjdns</em> over <em>OLSRD</em> over open WiFi), that provide an alternative communication medium resistant to severely disruptive situations. <br/>
<strong>A Janmesh box</strong> is a computing device (typically an unexpensive SoC/SbC computing device, or an old laptop) running as a Janmesh network node, connected to neighbourhood's nodes, and serving mesh connectivity and services toward the home LAN network<br/>
<div style="float;right;">
<h2>How is the Janmesh Project doing?</h2>
A full documentation to get a working CoOoOW stack with basic Ubuntu GNU/Linux computers is available. The network is up and runing at a local scale<br>
<h2>Documentation and tutorials</h2>
<h3>Beginner</h3>
Read how to, using wifi links and a CoOoOw stack, from scratch, setuo the mesh network. Then, learn more about firefalls to secure (network) access to your devices.  <a href="index-main.php">-Read more-</a>.
<br/>
<h3>Intermediate</h3>
Lear how to use one machine that operate Janmesh over Wifi and that is connected to Internet through Ethernet to act as a gateway and NAT box in order to allow other devices with (meshing) wifi only to share its Internet access.  <a href="intermediate.php">-Read more -</a>
<h3>MCPae</h3>
The software that is meant to be run on meshboxes, developed by the Janmesh Project, is called MCPae. It is not available for download for now, but there is <a href="./mcpae.php">some documentation about it</a>. 
<hr/>
</div>
<h2 style="clear:both;">And now learn more about citizen-to-citizen networking future...</h2>
<em>The connectivity to the mesh network can ben tunneled through a long-range directionnal radio link to connect distant communities</em><br/>
<strong>Or tunneled over Internet -or any other network medium- to rely distant places of the world</strong><br/>
<a href="index-main.php">Get started</a> or read more:
<h2>Frequently asked questions</h2>
<h3>What can I do with a Janmesh in my neighbourhood already? Do I have to wait for further developments to make something useful?</h3>
In short, you don't have to wait. If you have physical or remote access to your Janmesh node station, you can just use out-of-the-box any network services such as SCP, HTTP or SFTP/FTP file transfer or just any other common protocol, with the requirement that you'll have to know the IPv6 adress of the machine you'll want to talk to, and that the protocol supports IPv6 adressing (some protocols require hostnames and are then not suitable). 
<h3>Is Janmesh using only radio link? Can I use some other kind of networking medium? </h3>
You can use any networking medium to setup and operate your CoOoOw stacks. You can use an ethernet cable to connect with a close neighbour, as well as associated BPL interfaces to connect with other homes using the same electrical power transformator than you (typically, your block and nearest ones). 
<h3>Why Janmesh? Why spend your sweat and energy to propel the whole project?</h3>
I (<em>Shangri-l</em>) am not sure. I'm having fun with experimenting neigbourhood networking since the early 2000's. I just cannot prevent myself to stop. I was hoping my close neighbours would read all this and mesh with me, to aae share files or text messages or built whatever useful. This hasn't happened yet. That's the bad side of network effect. But if a few people start to join Janmesh, it will become more attractive, and the more people will use it, the more people will use it. That's the good side of network effect. 
<h1>Donate</h1>
<?php include ('../bank/index.php'); ?>
</body>
</html>
