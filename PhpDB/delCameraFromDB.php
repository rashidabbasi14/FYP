<?php
		session_start();
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$con=mysqli_connect('localhost','root','','rtfd');
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="delete from surveillance_camera where Camera_ID=".$_POST["field$i"];
				$result=$con->query($sql);
			}
			echo"Selected Cameras removed succesfully.";
		}
		else
			echo "No Camera was selected.";
	?>