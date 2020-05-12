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
		echo "<script>alert('You have been logged out.');location.href = 'logout.php'</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = time();
?>
