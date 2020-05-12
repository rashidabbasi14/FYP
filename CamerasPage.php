<style>
@import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
@import url('https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700');

h2{float:left; width:100%; color:#fff; margin-bottom:40px; font-size: 14px; position:relartive; z-index:3; margin-top:30px}
h2 span{font-family: 'Libre Baskerville', serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
h2 a{color:#fff; font-weight:bold;}

.head{float:left;width:100%;}
.search-box{width:95%; margin:0 auto 40px; box-shadow:20px 20px 0 rgba(0,0,0,0.2);}
.media {background: linear-gradient(to bottom, #514A9D, #24C6DC); position:relative; margin-bottom:15px;}
.media img{width:200px;margin:0; height:136px;}
.media-body{border:1px solid #bcbcbc; border-left:0; height:136px;}
.media .price{float:left; width:100%; font-size:30px;font-weight:600; color:#4765AB;}
.media .price small{display:block; font-size:17px; color:#232323;}
.media .stats{float:left; width:100%; margin-top:10px;}
.media .stats span{float:left; margin-right:10px; font-size:15px;}
.media .stats span i{margin-right:7px; color:#4765AB;}
.media .address{float:left; width:100%;font-size:14px; margin-top:5px; color:#888;}
.media .fav-box{position:absolute; right:10px; font-size:20px; top:4px; color:#E74C3C;}

</style>

<script>
		var hidden=0;
		var users=[];
	</script>

<div class="topnav">
	<div class="panel-body" id="DelButs" style="display:none;">
		<a class="active" href="#Add" id="DelSave" style="float:left;">Save</a>
		<a href="#Cancel" id="delBut1" style="float:left;">Cancel</a>
	</div>
	  <a class="active" href="#Add" id="addBut">Add</a>
	  <a href="#Delete" id="delBut">Delete</a>
</div>
<div id="includedContent" style="height: 520px; overflow:auto;">
<?php
	$CamID=$_GET["CameraID"];

	$con=mysqli_connect('localhost','root','','rtfd');
	$sql="select * from surveillance_camera where Camera_ID='$CamID';";
	$result=$con->query($sql);
	if($result->num_rows > 0)
	{
		$row=$result->fetch_assoc();
		$cam_name=$row["Name"];
		$dir = "RTFD/Input/Videos/$cam_name/";
		$a = scandir($dir);
		for($i=0;$i<sizeof($a);$i++)
		{
			if(strlen($a[$i]) > 2)
				print"
					<div class='media'>
						<video width='400' controls>
						  <source src='".$dir.$a[$i]."' type='video/mp4'>
						  Your browser does not support HTML5 video.
						</video>
						<div style='position:relative;'>
							<div class='price'><p style='display:inline;color:white;text-transform:capitalize;'>".str_replace(".jpg","",$a[$i])."</p></div>
							<div style='position:absolute; top:40%; right:10px;'><input value='".$dir.$a[$i]."' id='cbox".$dir.$a[$i]."' type='checkbox' style='display:none;'></div>
						</div>
					</div>	
				";
		}	
	}
?>
</div>
<script>
		$(document).ready(function(){
		  $("#addBut").click(function(){
			location.href = 'addUser.php';
		  });
		});
		$('#delBut, #delBut1').click(function(event) { 
			if(hidden==0)
			{
				$(':checkbox').each(function() {
					this.setAttribute("style","display:inline");                       
				});
				hidden=1;
				document.getElementById("DelButs").setAttribute("style","display:inline;");
			}
			else{
				$(':checkbox').each(function() {
				this.setAttribute("style","display:none;");                       
			});
			hidden=0;
			document.getElementById("DelButs").setAttribute("style","position: absolute; bottom:0; display:none;");
			}
		});
		$('#DelSave').click(function(event) 
		{ 
			var counter=0;
			var string='';
			$(':checkbox').each(function() {
				if(this.checked)
				{
					if(counter==0)
						string = string+'field'+counter+"="+this.value;
					else
						string = string+'&field'+counter+"="+this.value;
					counter++;
				}
			});
			string=string+"&count="+counter;
			
			var hr = new XMLHttpRequest();
			var url = "delUserFromDB.php";
			hr.open("POST",url,true);
			hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			hr.onreadystatechange=function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					var return_data = hr.responseText;
					r=confirm(return_data);
					document.location.href = "user.php";
				}
			}
			hr.send(string);
		});
	</script>