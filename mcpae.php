<?php
if ($_SERVER['SERVER_NAME']!=='janmesh.net')
{
	echo '<html><body>We moved to <a href="http://janmesh.net">janmesh.net</a></body></html>';
	die();
 }
?><!DOCTYPE html>
<html>
<head>
<title>Janmesh - Documentation - MCPae</title>
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
<a href="./">Home</a> > Documentation > MCPae	
<h1>MCPae for Janmesh - Documentation</h1>
<h2>MCPae - Introduction</h2>
MCPae is a web application meant to run over a <em>cjdns</em> virtual, secure network. <strong>It is not intended to be used on an Internet server</strong> since it relies entirely on cjdns to provide security and privacy. <br/>
It is developed as a part of the Janmesh project, a citizen-to-citizen networking initiative providing help to set up an alternative communication mean, resistant to severly disruptive conditions. <br/>
<br/>The Janmesh project focuses on neighbour-to-neighbour links (a.k.a Joint Access Mesh Networking) using a CoOoOw network stack (cjdns over olsrd over open wifi). <br/>
To learn more about all this, and before continuing to read about MCPae, please refer to the root of this site, <a href="./">http://janmesh.net</a> to make sure you will understand what is all this about. <br/>
<hr/>
MCPae provides a general frame for any purpose when used alongside a cjdns network. It is coded as a part of the Janmesh project, but besides meshlocals it can also be useful at the world scale such as an example with the Hyperboria global cjdns-powered network. <br/>
It is typically installed on a dedicated computing device ("meshbox") that is not too greedy for electric power and can be kept online 24 hours a day</br>
<br/>This is a web application, running on a web server, and therefore the services provided can be accessed, once the meshbox is plugged in into your home LAN router/access point, from any device of your household that features a web browser. <br/>
The core of MCPae is the Store, that can be used to distribute/install MCPae <em>modules</em> that add features to the main software. <br/>
<br/><em>Possible application could include file sharing, messaging, video calls, chatrooms, microblogging, social networking, online shops, music distribution, to mention just a few. </em>
<h2>How to install MCPae on your Janmesh device</h2>
...For now MCPae is still in early stage. It is therefore not currently available for download. <br/>
Currently, only the setup wizard is ready to use. This means you cannot do anything useful with the software. <br/>
What is planned is to add the "user account creation/deletion" feature first. Then, to add the necessary architecture (an API to work with) for modules to interact, with MCPae, with the user, with other instances of MCPae available on the Janmesh network, and with other modules installed on the same instance. <br/>
Then, to allow users to change settings (typically, change their password). And finally, to add at the admin level a module store ("the Store") which would allow to publish a module, to download a module from a specified Store, to republish a module downloaded before, to blacklist or uninstall modules. <br/>
<h3>System requirements</h3>
PHP >= 7.0<br/>
"Zip" php extension (often build-in in most distribution packages of PHP)<br/>
<h3>How to use the setup wizard for MCPae installation</h3>
<div style="border:solid 1px black"><strong>Important notice</strong>
Make sure to turn off Janmesh during the installation process to prevent for sure any confidential data leak. 
<code># /etc/init.d/janmesh stop<br/>
	  # nmcli conn down janmesh
</code>

</div>
<br/>
Cloning MCPae from git<br/>

Once logged in into your Janmesh box you'll have to:<br/>
<code>
$ git clone &lt;<em>Address not available for now, please check back in some dozens of weeks</em>&gt;
</code>
Create a directory in your public www dir. This directory will be refered as <em>the mountpoint</em> ; you can run several instances of MCPae on different mountpoints using the same HTTP server. <br/>
Copy the MCPae code there. <br/><br/>
Change the owner of the mountpoint directory to www-data with the command chown -R<br/>
Check with your web browser the address <strong>http://localhost/(mountpoint)</strong>
<br/>
If you  see a fatal error message indicating that some directories that have to be private are reachable from the outside, it means that your HTTP server don't apply the .htaccess directives. You'll have to tweak your http server configuration according to your own setup (in most case by editing the configuration file to "AllowOveride All". <br/>
<br/><br/>
You should see a message indcating that you have to edit a file to indicate your admin credentials<br/>
<em>note: </em> If you forget your admin credentials, you'll have to erase pwd.dat in the data/admin directory, and to restore (re-copy) the original admin_credentials.php, then to edit it accordingly to set a new password. <br/>
<br/>
edit-as root- the file (www_root)/(mountpoint)/data/admin/admin_credentials.php to set up your admin login and password. <br/>
<code>
# nano (www_root)/(mountpoint)/data/admin/admin_credentials.php
</code><br/>
...To set up the administrator login and password for your instance. <br/>
<br/>
next step will be to log in with the credential you just entered. The setup wizard will then ask you to indicate the IPv6 address of your tun0 interface. you can get it using the command<br/>
<code>$ ifconfig</code>
<br/>

<h3>How to block anything and allow only the port used by MCPae</h3>
You may want to use only services provided by MCPae -but beware, any other web application served by your HTTP server will remain accessible through the mesh.<br/>
If you want to allow a listening web server (port 80) and block anything else, for a mesh network operating on the tun0 interface:
as root: <br/>
<code>
# ufw deny in on tun0<br/>
# sudo ufw allow in on tun0 to any port 80<br/>
</code>
<h2>The basics of MCPae concepts: the addresses</h2>
The smallest unit for the purpose of running MCPae is the <em>instance identifier</em> built out of the IPv6 address of the instance followed by a double slash folowed by the mountpoint. 
<br/>
Example: <br/>
<code>1234:5678:91ab:cdef:fedc:ba19:8765:4321//mymountpoint</code>
<br/>
It is mostly useful only for inter-instance communications<br/>
<h3>The Store addresses</h3>
Any MCPae instance has the ability to let publish new modules that extends MCPae functionnalities, and also, to republish any module that have been installed from another Store. <br/>
<br/>The Store operates at administrator level, and only the administrator of an instance can install, uninstall, or activate/deactivate modules. <br/>
<br/>One of the first things you may want to do with a newly installed MCPae instance is to reach a Store to install new modules. <br/>
<br/>For this you will need to know its address, which is of the form: <br/>

<code>store://1234:5678:91ab:cdef:fedc:ba19:8765:4321//mymountpoint</code>

<br/>
Once a Store is added to your store list, you can browse module distributed there and install some of them. 

<h3>The User addresses</h3>
Administrator account and user accounts are separated entities. Users, as an example for Message purpose, are identified by an user ID. 
<br/>
The User ID can only include the following characters : <br/>
<code>
a-z<br/>
A-Z<br/>
0-9<br/>
.<br/>
-<br/>
_<br/>
</code>

The address (as an exemple, Message address) that is to be used when an user needs to be designated, is of the form: 
<br/>
<code>
userID#1234:5678:91ab:cdef:fedc:ba19:8765:4321//mymountpoint
</code>

<br/>
<h2>Modular architecture</h2>
<h3>Common methods to be implemented to create a module</h3>
<h3>The MCPae API available for module developers</h3>
<h3>Communication between MCPae front-end and a module</h3>
<h3>Communication between modules on the same instance</h3>
<h3>Communication between distant instances modules</h3>
<hr/>
Licensing: this tutorial is placed under two licenses. Code is placed under <a href="https://www.gnu.org/licenses/agpl-3.0.txt">AGPLv3</a> license. Other text content here is licensed under <a href="https://creativecommons.org/licenses/by-sa/4.0">Creative Commons BY-SA 4.0 license</a>. Authors are : Shangri-l. Translators are : Nomys. Translation proofreader are : Shangri-l
</body>
</html>
