<?php require 'auth.php'; ?>
<?php
$username=$_SESSION["username"];
$con=mysqli_connect('localhost','root','','rtfd');
$sql="select path from user_pictures where User_ID=(select user_id from user where username = '$username')";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$path=$row1["path"];
	$path;
}
$sql="select Count(*) as Count from surveillance_camera";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$No_Cam=$row1["Count"];
}
$sql="select Count(*) as Count from tracking";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$No_Track=$row1["Count"];
}

$sql="select Count(*) as Count from videos";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$No_Vid=$row1["Count"];
}
$sql="select Count(*) as Count from culprit";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$No_Cul=$row1["Count"];
}
$sql="select Count(*) as Count from user";
$result1=$con->query($sql);
if($result1->num_rows > 0)
{
	$row1=$result1->fetch_assoc();
	$No_Users=$row1["Count"];
}

?>

<div class="topnav">
	<img src="<?php echo $path;?>" height="70px" width="50px" style="float:right; border-radius:50%; margin:5px;">
	<p style="color:white;float:right;"> Welcome, <?php echo $username;?></p>
</div>
<section id="stats" class="count-up" style="margin:auto; height:300px;>
			<div class="row">
				<div class="col-twelve">
					<div class="block-1-6 block-s-1-3 block-tab-1-2 block-mob-full stats-list">
						<div class="bgrid stat">
							<div class="icon-part">
								<i class="icon-pencil-ruler"></i>
							</div>
							<h3 class="stat-count"><?php echo $No_Cam; ?></h3>
							<h5 class="stat-title">
								Numer of Cameras
							</h5>

						</div>

						<div class="bgrid stat">
							<div class="icon-part">
								<i class="icon-location-user"></i>
							</div>
							<h3 class="stat-count"><?php echo $No_Track; ?></h3>
							<h5 class="stat-title">
								Faces Recognized
							</h5>

						</div> <!-- /stat -->

						<div class="bgrid stat">

							<div class="icon-part">
								<i class="icon-rewards-medal-1"></i>
							</div>

							<h3 class="stat-count"><?php echo $No_Vid; ?></h3>

							<h5 class="stat-title">
								Number of Videos
							</h5>

						</div> <!-- /stat -->									

						<div class="bgrid stat">

							<div class="icon-part">
								<i class="icon-alien"></i>
							</div>

							<h3 class="stat-count"><?php echo $No_Cul; ?></h3>

							<h5 class="stat-title">
								Number of Culprits
							</h5>

						</div> <!-- /stat -->

						<div class="bgrid stat">

							<div class="icon-part">
								<i class="icon-coffee-mug"></i>
							</div>

							<h3 class="stat-count"><?php echo $No_Users; ?></h3>

							<h5 class="stat-title">
								People Using Our Survice
							</h5>

						</div> <!-- /stat -->

						<div class="bgrid stat">

							<div class="icon-part">
								<i class="icon-hourglass"></i>
							</div>

							<h3 class="stat-count">80%+</h3>

							<h5 class="stat-title">
								Real Time
							</h5>

						</div> <!-- /stat -->

					</div> <!-- /stats-list -->

				</div> <!-- /twelve -->
			</div> <!-- /row -->

		</section> <!-- /stats -->