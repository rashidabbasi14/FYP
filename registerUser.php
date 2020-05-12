<!doctype html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/layoutr.css">
	</head>
	
	<style>
	body {
		background-image: url("Images/image.jpg");
	}
	</style>
	
	<body background="image.jpg">
	<?php	
	$con=mysqli_connect('localhost','root','','rtfd');
	if(isset($_POST["Submit"]))
	{
		if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["Name"]) && !empty($_POST["Password"]))
		{
			$sql="INSERT INTO `user` (`User_ID`, `username`, `email`, `Name`, `Password`, `Admin_Privileges`) VALUES (NULL, '".$_POST["username"]."', '".$_POST["email"]."', '".$_POST["Name"]."', '".$_POST["Password"]."', 0);";				   
			$result=$con->query($sql);
			echo "<script>alert('Successfully Added.'); location.href = 'login.php';</script>";
		}	
		else
			echo "<script>alert('Please fill all the fields.');</script>";
	}
	?>
		<img src="images/logo.png" width="100" height="70">
		<div class="login-box">
		<h1>Register Here</h1>
			<form action="" method="POST">
				<p>Username</p>
				<input type="text" name="username" placeholder="Enter Username">
				<p>Full Name</p>
				<input type="text" name="Name" placeholder="Enter Name">
				<p>Password</p>
				<input type="password" class="password" name="Password" placeholder="Password">
				<p>Email</p>
				<input type="text" name="email" placeholder="Enter Email">
				<input type="submit" name="Submit" value="Register">
			</form>
			Already have an Account? <a href='login.php' style='color:blue'>Sign In</a>.
		</div>
	</body>
</html>