<?php
	$id = $_GET["Culprit"];
	function cleanString($str){
		return str_replace(".jpg","",$str);
	}
	$con=mysqli_connect('localhost','root','','rtfd');
	$sql="select * from tracking where culprit_id = $id group by video_id;";
	$result=$con->query($sql);
	$cam = array();
	if($result->num_rows > 0)
	{
		while($row=$result->fetch_assoc())
		{
			$sql="select * from videos where video_id = ".$row["Video_ID"];
			$result1=$con->query($sql);
			if($result1->num_rows > 0)
			{
				while($row1=$result1->fetch_assoc())
				{
					if (!in_array($row1["Camera_ID"], $cam)) {
						array_push($cam,$row1["Camera_ID"]);
					}
				}
			}
		}
	}
	$arrayobj = new ArrayObject();
	for($i=0;$i<sizeof($cam);$i++)
	{
		$det = array();
		$sql="select * from surveillance_camera where camera_id = ".$cam[$i];
		$result1=$con->query($sql);
		if($result1->num_rows > 0)
		{
			$row1=$result1->fetch_assoc();
			array_push($det,$row1["Camera_ID"]);
			array_push($det,$row1["Name"]);
			array_push($det,$row1["Location"]);
			array_push($det,$row1["lng"]);
			array_push($det,$row1["lat"]);
		}
		$arrayobj->append($det);
		$det = array();
		$sql="select * from tracking where culprit_id = $id and video_id in (select video_id from videos where Camera_ID = ".$cam[$i].");";
		$result1=$con->query($sql);
		if($result1->num_rows > 0)
		{
			$json = mysqli_fetch_all ($result1, MYSQLI_NUM);
			$arrayobj->append($json);
		}
	}
	//$json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	json_encode($arrayobj);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
td, th {
  color: white;
  font-size: 20px;
}
</style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqIkum98J4DlHQXmfQq1f_yUtsWxQ95I8&callback=initMap">
  </script>
  <style>
    #map{
      height:400px;
      width:100%;
    }
  </style>
</head>
<body>
<div style="height: 600px; overflow:auto;padding:10px;">
  <h1 style="font-size: 20px; color:white">Track Report of Culprit ID: <?php echo cleanString($_GET["Culprit"]);?></h1>
  <div id="map"></div>
  <br><br>
  
  <div style='color:white'>
	<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Track#</th>
      <th scope="col">Location</th>
      <th scope="col">Time</th>
      <th scope="col">Video</th>
    </tr>
  </thead>
  <tbody>   
	<?php
		$con=mysqli_connect('localhost','root','','rtfd');
		$sql="select * from tracking where culprit_id = $id and User_Vid = 0";
		$result=$con->query($sql);
		if($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{
				echo '<tr>
				  <th scope="row">'.$row["Track_ID"].'</th>';
				$sql='select * from videos where video_id = '.$row["Video_ID"];
				$result1=$con->query($sql);
				if($result1->num_rows > 0)
				{
					$row1=$result1->fetch_assoc();
					$cam_id= $row1["Camera_ID"];
				}
				$sql='select * from surveillance_camera where camera_id = '.$cam_id;
				$result2=$con->query($sql);
				if($result2->num_rows > 0)
				{
					$row2=$result2->fetch_assoc();
					$location=$row2["Location"];
				}
				$sql='select * from track_video where track_id = '.$row["Track_ID"];
				$result1=$con->query($sql);
				$path=null;
				if($result1->num_rows > 0)
				{
					$row1=$result1->fetch_assoc();
					$path = $row1["path"];
				}
				if($path)
				echo ' <td>'.$location.'</td>
				  <td>'.$row["VidTime"].'</td>
				  <td><video width="400" controls>
						  <source src="'.$path.'" type="video/mp4">
						  Your browser does not support HTML5 video.
						</video></td>
				</tr>';
				else
					echo ' <td>'.$location.'</td>
				  <td>'.$row["VidTime"].'</td>
				  <td>N/A</td>
				</tr>';
			}
		}
		
		$sql="select * from tracking where culprit_id = $id and User_Vid = 1";
		$result=$con->query($sql);
		if($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{
				echo '<tr>
				  <th scope="row">'.$row["Track_ID"].'</th>';
				$sql='select * from user_videos where video_id = '.$row["Video_ID"];
				$result1=$con->query($sql);
				if($result1->num_rows > 0)
				{
					$row1=$result1->fetch_assoc();
					$cam_id= $row1["User_ID"];
				}
				$sql='select * from user where user_id = '.$cam_id;
				$result2=$con->query($sql);
				if($result2->num_rows > 0)
				{
					$row2=$result2->fetch_assoc();
					$location=$row2["Name"];
				}
				$sql='select * from track_video where track_id = '.$row["Track_ID"];
				$result1=$con->query($sql);
				$path=null;
				if($result1->num_rows > 0)
				{
					$row1=$result1->fetch_assoc();
					$path = $row1["path"];
				}
				if($path)
				echo ' <td>User: '.$location.'</td>
				  <td>'.$row["VidTime"].'</td>
				  <td><video width="400" controls>
						  <source src="'.$path.'" type="video/mp4">
						  Your browser does not support HTML5 video.
						</video></td>
				</tr>';
				else
					echo ' <td>'.$location.'</td>
				  <td>'.$row["VidTime"].'</td>
				  <td>N/A</td>
				</tr>';
			}
		}
	?>
	</tbody>
	</table>
  </div>
</div>
  
  <script>
	
	var data = JSON.parse('<?php echo json_encode($arrayobj); ?>');
	const keys = Object.values(data);
    function initMap()
	{
      // Map options
      var options = {
        zoom:10,
        center:{lat:24.980554,lng:67.228413}
      }

      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);
      var markers = [];
	  
	 // markers.push({coords:{lat:24.857824,lng:67.264341},content:'<h1>Test</h1><br>Culprit was here at time: >'});
	
	for(var i=0;i<keys.length;i+=2)
	{
		var str='';
		for(var j=0;j<keys[i+1].length;j++)
		{
			str += "Track ID: " + keys[i+1][j][0] + " on Video "+  keys[i+1][j][1] +" at Time: " + keys[i+1][j][2] +"<br>";
		}
		markers.push({
          coords:{lat:parseFloat(keys[i][3]),lng:parseFloat(keys[i][4])},
          content:'<h1>'+ keys[i][2] +'</h1><br>' + str
		  
        });
	}
      // Loop through markers
      for(var i = 0;i < markers.length;i++){
        // Add marker
        addMarker(markers[i]);
      }

      // Add Marker Function
      function addMarker(props){
        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          //icon:props.iconImage
        });

        // Check for customicon
        if(props.iconImage){
          // Set icon image
          marker.setIcon(props.iconImage);
        }

        // Check content
        if(props.content){
          var infoWindow = new google.maps.InfoWindow({
            content:props.content
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });
        }
      }
    }
  </script>
</body>
</html>
