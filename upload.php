<?php
	session_start();
	$con=mysqli_connect('localhost','root','','rtfd');
	$username=$_SESSION["username"];
	$sql="select * from user where username='$username'";
	$result1=$con->query($sql);	
	if($result1->num_rows > 0)
	{
		$row1=$result1->fetch_assoc();
		$id=$row1["User_ID"];
	}
	$target_dir = "RTFD/Input/Videos/User/";
	if (!file_exists($target_dir)) {
		mkdir($target_dir, 0777, true);
	}
	
	$allowedExts = array("mp4");
	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	if (($_FILES["file"]["size"] < 20000000000000) && in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";	
		else
		{
			if (file_exists($target_dir . $_FILES["file"]["name"]))
				echo "<script>alert('File already exists.');</script> ";
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				$target_dir . $_FILES["file"]["name"]);
				$sql="INSERT INTO `user_videos` (`P_Check`, `A_Check`, `Path`, `Timestamp`, `User_ID`) VALUES (0, 0, 'Input/Videos/User/" . $_FILES["file"]["name"]."', CURRENT_TIMESTAMP, $id);";				   
				$result=$con->query($sql);
				echo "<script>alert('Thank you for uploading and helping the community.');</script>";
			}
		}
	}
	else
		echo "<script>alert('Invalid file, only MP4 format allowed and Size Should be less than 2GB');</script>";
	echo "<script>location.href = 'userPortal.php'</script>";

?>