<!DOCTYPE html/>
<html>
<title>Janmesh - Documentation - Ocsad</title>
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
<a href="../">Janmesh.net</a> &gt; Documentation - Ocsad
<h1>Ocsad - Open Cjdns Services Announcement and Discovery</h1>
Ocsad is currently in "early design" phase. This page is here to introduce design to be used and to help developpers collaborate. 
<h2>Introduction</h2>
Ocsad is a cross-platform GUI application written using Python-GTK3 and Glade. 
<br/>It has the purpose to provide a way to : <ul>
<li>publicly announce which open services are running on the hosting machine and allow other users of the cjdns network to discover and therefore use them. </li>
<li>discover open services available on other Ocsad-enabled stations or devices of the cjdns network. </li>
<h3>GUI</h3>

The git repo was just created: <a href="https://github.com/janmeshnet/ocsad" target="new">https://github.com/janmeshnet/ocsad</a> and currently allows to see how the UI of the app may look. It requires GTK3, Python, Python-GTK. 





<h3>Overview</h3>
The discovering and announcement features are provided this way :
<br/>For the announcement side, the <em>advertizer</em> listens on the 22557 port. Each times a client connects, it delivers a formated response which is a formated list of any open service on this machine that its user wanted to advertise, and that are hopefuly currently running, usable, on it. 
<br/>For the discovering side, the <em>crawler</em> sends API queries to the cjdroute process running on the same machine, in order to optain ipv6 adresses of closest peers, their closest peers, and so on. Then these hosts at the ipv6 addresses got their 22557 port scanned for a possible reply of an Ocsad advertizer, then the crawler stores the response's data if any. 
<h2>Typical use</h2>
<h3>Main window tabs</h3>

<br/>
<strong>The section with emphasis starting below is a bit outdated and keep for reference, but building from git and see the working UI is quite more precise for features and navigation concepts</strong>
<br/>


<em>
The main window is made of tabs. The default tab is the "favorite tab". This tab lists the stations currenly marked as "favorite" and allows to see and access their currently live open services. The informations from the "Favorite" tab are build at startup by the crawler querying each favorite. Non responding ones are marked offline. 
<br/><hr/>
The next tab is the "search tab". It allows to search in what currently contains the <em>library</em> local storage of gathered information from already crawled peers. The search can by filtered to one or more fields that are made available by the other computer owner's advertizer for each of its entries. Namely "service name", "service description", "service port", "service  protocol", "service url prefix" (available only if applicable), "service custom prebuilt url" (available only if applicable). 
<br/><hr§>
Once the search starts, the tab display matching peers, allowing to see matching service and to access other service's list. 
<br/><hr/>
The next tab is the "publicly listed open services" tab, which allows to edit the following fields (all of them are optionals)
<br/>-the free form "station name", meant to be a short and memorable handle to help other people find and find again the profile and who is behind. The field can be up to 140 characters but long name are likely to be displayed truncated by clients. 
<br/>-the GPS-style decimals indicating the latitude and longitude of real world geographical coordinates of the station, as the user whished to have them set if so. 
<br/>-an url of a (cjdns networK) live web (http) server-served digital image file that will be used by client sofwares as a personnal avatar to represent the machine or its operator. Of the form <em>http://[&lt;ipv6 address&gt;]:&lt;port&gt;/path/to/image.extension</em>. 
<br/>-a free form long description of station's services, aims, services-related information. Cannot be more than 5000 words. 
<br/>-the formated services list, with the following informations indicated, one par line, in this order, with the indicated maximum size : "service name" (30 characters), "service description" (250 words), "service port" (5 digits), "service  protocol" (140 characters), "service url prefix" (can be a blank line, 24 characters), "service custom prebuilt url" (can be a blank line, finited values character count only)
<hr/>
The next tab is the "settings" tab, allowing to set parameters like: <br/>
Delay between two services query : an arbitrary number expressed in seconds, with microsecond digit precision, indicating how long the crawler should pause each time it finished to crawl a node before it send query to the next one in queue. 
<hr/>
The next tab is the Journal tab, which logs events and actions occuring while using the software. </em>
<hr/>
<h3>Menu bar</h3>
The menu bar presents : <br/>
File: Quit<br/>
Help : About<br/>
<h2>Technical design</h2>

Ocsad does not make uses of SQL databases and manages data storage by associative array serialization. The actual files on disk should be storing the smallest possible information unit each, and general code design should tend to load these units for a small duration only. 

</body>


</html>
