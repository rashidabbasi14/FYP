<?php
	session_start();
	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	
	$con=mysqli_connect('localhost','root','','rtfd');
	$username=$_SESSION["username"];
	$sql="select username from user where username='$username' and password='$password';";
	$result=$con->query($sql);	
	if($result->num_rows <= 0)
	{
		echo "<script>location.href = 'login.php'</script>";
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
		echo "<script>location.href = 'logout.php'</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<head>
	<style>
	#center-div
	{
	  position: absolute;
	  margin: auto;
	  top: 50%;
	  right: 0px;
	  bottom: 0px;
	  left: 0px;
	  width: 500px;
	  height: 300px;
	  background-color: #ccc;
	  border-radius: 3px;
	  text-align:center;
	  
	}
	#fileToUpload:hover{
		background-color: red;
		cursor: pointer;
	}
	.topnav {
	  overflow: hidden;
	  background-color: #333;
	  margin-bottom: 20px;
	}

	.topnav a {
	  float: left;
	  text-align: center;
	  background-color: #4CAF50;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 17px;
	  color: black;
	}

	.topnav a:hover {
	  background-color: #ddd;
	  color: black;
	}

	.topnav a.active {
		float: right;
	  background-color: #4CAF50;
	  color: white;
	}
</style>
	
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   
   <!--- basic page needs
   ================================================== -->
   <meta charset="utf-8">
	<title>CertifiedChain</title>
	<meta name="description" content="">  
	<meta name="author" content="M.Wadeed Siddiqui">

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
	<script src="js/modernizr.js"></script>
	<script src="js/pace.min.js"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	

   <!-- favicons
	================================================== -->
	<link rel="icon" type="image/x-icon" href="images/favicon.ico">

</head>

<body id="top">
	
	<!-- header 
   ================================================== -->
   <header class="main-header">
		<div class="logo">
			<a href="index.html">RDFT</a>
		</div> 
	</header>
    <section id="intro">
         <div class="row intro-content">
            <div class="col-twelve">
               <h1 class="animate-intro">
                 User Portal
               </h1>   
            </div> <!-- /twelve -->                   
         </div> <!-- /row -->
    </section> <!-- /intro -->
	
	<div class="topnav">
		<img src="images/download.png" height="70px" width="50px" style="float:right; border-radius:50%; margin:5px;">
		<p style="color:white;float:right; position:absolute;right:10px;top:200px;"> Welcome, <?php echo $username;?></p>
		<a class="active" href="logout.php">Logout</a>
		<a href="logout.php">View Videos</a>
	</div>


	<div id="center-div">
		<br><h3>Upload video here</h3>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file" id="file">
			<input type="submit" value="Submit" name="submit">
		</form>
	</div>
	


<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>




</body>
</html>