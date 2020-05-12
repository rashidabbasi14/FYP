<?php 
	if(isset($_POST["submit"]) && !empty($_POST["Name"]))
	{
		$con=mysqli_connect('localhost','root','','rtfd');
		$sql="INSERT INTO `culprit` (`Culprit_ID`, `Name`, `Description`, `Age`, `Phone_Number`, `Address`) VALUES (NULL, '".$_POST["Name"]."', '".$_POST["Description"]."', '".$_POST["Age"]."', '".$_POST["Phone_Number"]."', '".$_POST["Address"]."');";				   
		$result=$con->query($sql);
		$target_dir = "../RTFD/Input/Culprits/";
		if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"]))
		{
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					echo "<script>alert('File is not an image.'); location.href = '../adminPortal.php';</script>";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "<script>alert('Sorry, file already exists.');location.href = '../adminPortal.php';</script>";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "<script>alert('Sorry, your file is too large.'); location.href = '../adminPortal.php';</script>";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); location.href = '../adminPortal.php';</script>";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "<script>alert('Sorry, your file was not uploaded.'); location.href = '../adminPortal.php';</script>";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$sql="select * from culprit where name = '".$_POST["Name"]."';";
					$result=$con->query($sql);
					if($result->num_rows > 0){
						$row=$result->fetch_assoc();
						$id=$row["Culprit_ID"];
					}
					$test="RTFD\\\\Input\\\\Culprits\\\\";
					$sql="INSERT INTO `culprit_pictures` (`Culprit_ID`, `Path`) VALUES ('$id', '".$test.basename($_FILES["fileToUpload"]["name"])."');";
					$result=$con->query($sql);
					echo "<script>alert('Successfully Added.'); location.href = '../adminPortal.php';</script>";
				} else {
					echo "<script>alert('Sorry, there was an error uploading your file.'); location.href = '../adminPortal.php';</script>";
				}
			}
		}
		else
			echo "<script>alert('Successfully Added.'); location.href = '../adminPortal.php';</script>";
	}
	else if(isset($_POST["cancel"]))
		echo "<script>location.href = '../adminPortal.php';</script>";
	else
		echo "<script>alert('Please fill all the fields.'); location.href = '../adminPortal.php';</script>";

?>