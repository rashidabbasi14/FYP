		<div class="topnav" id="invPanel">
					<div class="panel panel-default" style="position:relative;">
					  <div class="panel-body">	
							<a class="active" id="addBut" href="#Add" id="addBut">Save</a>
							<a href="#Users" id="CanBut">Cancel</a>
					  </div>
					</div>
				</div>
			<div style="margin:auto;padding: 0px 50px 0px 50px;width:50%;">
				<?php
					echo "<div style='margin:0 auto;width: 200px;'><h1 style='color:white;'>Add User</h></div><br><br>";
					
					$con=mysqli_connect('localhost','root','','rtfd');
					$sql="show columns from user";
					$result=$con->query($sql);
					if($result->num_rows > 0) {
						while($row=$result->fetch_assoc()) {
							if($result->num_rows > 0) {
								$col=$row["Field"];
								$test='"Lucida Sans Unicode"';
								if($col=="Password")
									echo "<div style='float:left'><p style='font-size:18px; font-style: bold; color:white;'>$col</p></div> <div style='float:right'><input type='password' id='inp$col' value=''></div><br><br>";
								else
									echo "<div style='float:left'><p style='font-size:18px; font-style: bold; color:white;'>$col</p></div> <div style='float:right'><input id='inp$col' value=''></div><br><br>";
							}
						}
					}
				?>
			<div style='float:left'><p style='font-size:18px; font-style: bold; color:white;'>Picture</p></div> <div style='float:right'><input type='file' name='fileToUpload' id='fileToUpload'></div><br><br>
			</div>
	<script>
			var counter = 0;
			var string = '';
			
			$(document).ready(function(){
			  $("#CanBut").click(function(){
				 document.location.href = "adminPortal.php#Users";
			  });
			});
			
			$(document).ready(function(){
				$("#addBut").click(function(){
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
						var url = "addUserToDB.php";
						hr.open("POST",url,true);
						hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						hr.onreadystatechange=function()
						{
							if(hr.readyState == 4 && hr.status == 200)
							{
								var return_data = hr.responseText;
								r=confirm(return_data);
								location.href = 'adduser.php';
							}
						}
						hr.send(string);
					}
					else
						alert("Fields cannot be empty.");
				});
			});
			
	</script>