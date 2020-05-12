<?php require 'auth.php'; ?>
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

<html>
	<script>
		var hidden=0;
		var users=[];
		
		function reply_click(clicked_id)
		{
			$("#SubDiv").load("userPage.php?user="+clicked_id); 
		}
	</script>
	<body>
		<div id="SubbDiv">
			<div class="topnav">
				<div class="panel-body" id="DelButs" style="display:none;">
					<a class="active" href="#Add" id="DelSave" style="float:left;">Save</a>
					<a href="#Cancel" id="delBut1" style="float:left;">Cancel</a>
				</div>
				  <a class="active" id="addBut" href="#Add" id="addBut">Add</a>
				  <a href="#Delete" id="delBut">Update</a>
			</div>
			<div id="includedContent" style="height: 520px; overflow:auto;">
			<?php
				$con=mysqli_connect('localhost','root','','rtfd');
				$sql="select user_id, username, Admin_Privileges from user;";
				$result=$con->query($sql);
				if($result->num_rows > 0)
				{
					while($row=$result->fetch_assoc())
					{
						$user=$row["username"];
						$userid=$row["user_id"];
						$status=($row["Admin_Privileges"] ? "Admin" : "Standard User");
						$sql="select path from user_pictures where User_ID=$userid;";
						$result1=$con->query($sql);
						if($result1->num_rows > 0)
						{
							$row1=$result1->fetch_assoc();
							$path=$row1["path"];
						}
						else
							$path="RTFD\Input\Users\NA.png";
						
						echo "
						<a onClick='reply_click(this.id)' id='$user'>
							<div class='media'>
								<img src='$path' height='100px' width='150px' style='margin-right:20px;border-radius: 50%;'>
								<div style='position:relative;'>
									<div class='price'><p style='display:inline;color:white;text-transform:capitalize;'>$user</p><small>$status</small></div>
									<div class='stats'>
										<span><i class='fa fa-arrows-alt'></i>Number of found on Camera</span>
									</div>
									<div class='address'>Some discription</div>
								</div>
								<div style='position:absolute; top:40%; right:20px;'><input value='$user' id='cbox$user' type='checkbox' style='display:none;'></div>
							</div>
						</a>
						";
					}
				}
			?>
			</div>
		</div>
	</body>

	<script>
		$(document).ready(function(){
		  $("#addBut").click(function(){
			$("#SubbDiv").load("adduser.php"); 
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

</html>




