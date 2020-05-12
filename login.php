<!doctype html>

<html>
	<head>
		<title>RTFD</title>
		<link rel="stylesheet" type="text/css" href="CSS/layout.css">
	</head>
	
	<style>
	body {
		background-image: url("Images/image.jpg");
	}
	</style>
	
	<body background="image.jpg">
	<?php	
			$con=mysqli_connect('localhost','root','','rtfd');
			$username=isset($_POST["Username"]) ? $_POST["Username"] : '';
			$password=isset($_POST["Password"]) ? $_POST["Password"] : '';
			if(isset($_POST["Submit"]))
			{
				$sql="select username, Admin_Privileges from user where username='$username' and password='$password';";
				$result=$con->query($sql);	
				if($result->num_rows > 0)
				{
					$row=$result->fetch_assoc();
					$status=$row["Admin_Privileges"];
					while($row=$result->fetch_assoc())
							{
								$asset=$row["name"];
								$sql="select count(item_code) from $asset;";
								$result1=$con->query($sql);
								if(isset($result1->num_rows)? $result1->num_rows > 0:0)
									$row1=$result1->fetch_assoc();
								else
									$row1=0;
								
								$count=$row1["count(item_code)"];
								echo "<li><a href='assetPage.php?asset=$asset'>$asset ($count)</a><div style='position:absolute; display:inline; right:10;'><input value='$asset' id='cbox$asset' type='checkbox' style='display:none;'></div></li>";
						
							}
							
					session_start();
					$_SESSION['LAST_ACTIVITY'] = time();
					$_SESSION["username"]=$username;
					$_SESSION["password"]=$password;
					if($status)
						echo "<script>location.href = 'adminPortal.php'</script>";
					else
						echo "<script>location.href = 'userPortal.php'</script>";
				}
				else
				{
					echo "<script>alert('Invalid Username and Password')</script>";
				}
			}
	?>
		<img src="images/logo.png" width="100" height="70">
		
		<div class="login-box">
		<h1>Login Here</h1>
			<form action="" method="POST">
				<p>Username</p>
				<input type="text" name="Username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" class="password" name="Password" placeholder="Password">
				<input type="submit" name="Submit" value="Login">
			</form>
			Not registered? <a href='registerUser.php' style='color:blue'>Sign Up</a>.
		</div>
	</body>
</html>
