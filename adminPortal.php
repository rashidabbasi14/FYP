<?php require 'auth.php'; ?>
<!DOCTYPE html>
<head>
	<style>
	.topnav {
	  overflow: hidden;
	  background-color: #333;
	  margin-bottom: 20px;
	}

	.topnav a {
	  float: right;
	  color: #f2f2f2;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 17px;
	}

	.topnav a:hover {
	  background-color: #ddd;
	  color: black;
	}

	.topnav a.active {
	  background-color: #4CAF50;
	  color: white;
	}
</style>
	
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   
   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>RTFD</title>

   <!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 	<!-- CSS
   ================================================== -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/base.css"> 
	<link rel="stylesheet" href="css/vendor.css"> 
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/admin.css">	   

   <!-- script
   ================================================== -->	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
		

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/x-icon" href="images/favicon.ico">

</head>

<body id="top">
	
	<!-- header 
   ================================================== -->
   <header class="main-header">
		<div class="logo">
			<a href="index.html">RTFD</a>
		</div> 
	</header>
    <section id="intro">
         <div class="row intro-content">
            <div class="col-twelve">
               <h1 class="animate-intro">
                 Admin Portal
               </h1>   
            </div> <!-- /twelve -->                   
         </div> <!-- /row -->
    </section> <!-- /intro -->
	
	
		<div>
			<div id='cssmenu' style='height:600px; float:left;'>
				<br>
				<br>
				<ul>
				   <li class='active'><a href='#Home' id="Home"><span>Home</span></a></li>
				   <li><a href='#Culprits' id="Culprits"><span>Culprits</span></a></li>
				   <li><a href='#Users' id="Users"><span>Users</span></a></li>
				   <li><a href='#Cameras' id="Cameras"><span>Cameras</span></a></li>
				   <li class='last'><a href='#Logout' id="Logout"><span>Logout</span></a></li>
				</ul>
			</div>
			
			<div>
				
				<script>
				window.addEventListener("load", f1);
				window.addEventListener("hashchange", f1);
				location.hash="#Home";
				function f1() {
				  var x = location.hash;
				  if(x=="#Home"){
					  $("#SubDiv").load("Home.php");
				  }
				  else if(x=="#Culprits"){
					  $("#SubDiv").load("Culprits.php");
				  }
				  else if(x=="#Users"){
					  $("#SubDiv").load("user.php");
				  }
				  else if(x=="#Cameras"){
					  $("#SubDiv").load("camera.php");
				  }
				  else if(x=="#Logout"){
					  $("#SubDiv").load("logout.php");
				  }
				}
				</script>
				
				 <div id="SubDiv" style="overflow:auto;"></div>
			</div>
		</div>
</body>
</html>