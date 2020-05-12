<?php require 'auth.php'; ?>
<head>
	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqIkum98J4DlHQXmfQq1f_yUtsWxQ95I8&callback=initMap">
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
	<div id="includedContent" style="height: 520px; overflow:auto;">
		<div style='width:50%; margin:auto;'>
			<form action="PhpDB/addCameraToDB.php" method="post" enctype="multipart/form-data">
			<?php
				echo "<div style='margin:0 auto;width: 200px;'><h1 style='color:black;'>Add Camera</h></div><br><br>";
				$con=mysqli_connect('localhost','root','','rtfd');
				$sql="show columns from surveillance_camera";
				$result=$con->query($sql);
				if($result->num_rows > 0) {
					while($row=$result->fetch_assoc()) {
						if($result->num_rows > 0) {
							$col=$row["Field"];
							$test='"Lucida Sans Unicode"';
							if($col=="picturepath")	
								echo "$col <div style='position:absolute; display:inline; left:100;'><input id='$col' type='file' name='fileToUpload' id='fileToUpload'></div><br><br>";
							else if($col != "Camera_ID")
								echo "<div style='float:left'><p style='font-size:18px; font-style: bold; color:black;'>$col</p></div> <div style='float:right'><input id='$col' name='$col' value=''></div><br><br>";
						}
					}
				}				
			?>
			 <input style='margin:0 auto;' type="submit" value="Add" name="submit">
			 <input style='margin:0 auto;' type="submit" value="Cancel" name="cancel">
			</form>
		</div>
		<h1>Choose Location from Map</h1>
		<div id="map"></div><br><br>
		<style>
			#map{
			  height:400px;
			  width:100%;
			}
		 </style>
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
			
			function initMap(){
			  // Map options
			  var options = {
				zoom:10,
				center:{lat:24.980554,lng:67.228413}
			  }

			  // New map
			  var map = new google.maps.Map(document.getElementById('map'), options);

			  // Listen for click on map
			  google.maps.event.addListener(map, 'click', function(event){
				// Add marker
				document.getElementById("lat").value = event.latLng.lat();
				document.getElementById("lng").value =event.latLng.lng();
			  });
			  

			}
	</script>