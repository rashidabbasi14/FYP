<?php 
	if(isset($_POST["submit"]) && !empty($_POST["Name"]) && !empty($_POST["Location"]) && !empty($_POST["lng"]) && !empty($_POST["lat"]))
	{
		$con=mysqli_connect('localhost','root','','rtfd');
		$sql="INSERT INTO `surveillance_camera` (`Name`, `Location`, `lng`, `lat`) VALUES ('".$_POST["Name"]."', '".$_POST["Location"]."', '".$_POST["lng"]."', '".$_POST["lat"]."');";				   
		$result=$con->query($sql);
		$target_dir = '../RTFD/Input/Videos/'.$_POST["Name"];
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		echo "<script>alert('Successfully Added.'); location.href = '../adminPortal.php';</script>";
	}
	else if(isset($_POST["cancel"]))
		echo "<script>location.href = '../adminPortal.php';</script>";
	else
		echo "<script>alert('Please fill all the fields.'); location.href = '../adminPortal.php';</script>";

?>