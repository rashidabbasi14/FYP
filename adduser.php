<?php require 'auth.php'; ?>
<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<div style='width:50%; margin:auto;'>
			<form action="PhpDB/addUserToDB.php" method="post" enctype="multipart/form-data">
			<?php
				echo "<div style='margin:0 auto;width: 200px;'><h1 style='color:black;'>Add User</h></div><br><br>";
				$con=mysqli_connect('localhost','root','','rtfd');
				$sql="show columns from user";
				$result=$con->query($sql);
				if($result->num_rows > 0) {
					while($row=$result->fetch_assoc()) {
						if($result->num_rows > 0) {
							$col=$row["Field"];
							$test='"Lucida Sans Unicode"';
							if($col=="picturepath")	
								echo "$col <div style='position:absolute; display:inline; left:100;'><input id='$col' type='file' name='fileToUpload' id='fileToUpload'></div><br><br>";
							else if($col == "Admin_Privileges")
								echo ' <input type="radio" name="'.$col.'" value="0" checked> Standard user <input type="radio" name="'.$col.'" value="1"> Admin<br><br>';
							else if($col != "User_ID")
								echo "<div style='float:left'><p style='font-size:18px; font-style: bold; color:black;'>$col</p></div> <div style='float:right'><input name='$col' value=''></div><br><br>";
						}
					}
				}			
			?>
			<div style='position:absolute; display:inline; left:100;'><input type='file' name='fileToUpload' id='fileToUpload'></div><br><br>
			 <input style='margin:0 auto;' type="submit" value="Add" name="submit">
			 <input style='margin:0 auto;' type="submit" value="Cancel" name="cancel">
			</form>
			
		</div>
	</body>
	<script>
			var counter = 0;
			var string = '';
			
			function itemSave()
			{
				var counter=0;
				var flag=0;
				$("input").each(function(){
					if(this.value!=''){
						if(counter==0)
								string = string+'field'+counter+"="+this.value;
							else
								string = string+'&field'+counter+"="+this.value;
							counter++;
					}
					else
						flag=1;
				});
				if(flag==0){
					var hr = new XMLHttpRequest();
					var url = "phpdb/addtoolToDB.php";
					hr.open("POST",url,true);
					hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					hr.onreadystatechange=function()
					{
						if(hr.readyState == 4 && hr.status == 200)
						{
							var return_data = hr.responseText;
							r=confirm(return_data);
							location.href = 'addtool.php';
						}
					}
					hr.send(string);
				}
				else
					alert("Fields cannot be empty.");
			}
	</script>