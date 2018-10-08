<?php
session_start();
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
   echo "<script>window.location = 'login.php'</script>";
}
include "main_data.php";
include "stats.php";
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>IN-OUT MGNT SYSTEM</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/main.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	</head>
	<body onload="startTime()">
		<section class="head">
			<div class="container-fluid">
				<div class="row">
				<!-- <div class="col-xs-2 col-md-2 col-lg-2">
					<img src="img/logo.jpg" height="125" width="125">
				</div> -->
					<div class="col-xs-12 col-md-12 col-lg-12 text-center main_title" >
						<div class="h1 title" style="font-size: 29px;"><b><?php echo $cname[0]; ?></b></div>
						<div class="h2 sub_title"><b>Welcome to <?php echo $_SESSION['loc']; ?></b><br><h3>In / Out Management System</h3></div>
						
					</div>
				<!-- <div class="col-xs-2 col-md-2 col-lg-2" >
					<img src="img/iso.png" style="float:right;" height="125" width="125">
				</div> -->
				</div>
			</div>
		</section>
		<section class="main">
			<div class="container-fluid">
				<div class="col-xs-3 col-md-3 col-lg-3">
					<?php
                        if ($e_img != NULL) {
                     ?>
					<article class="card animated fadeInLeft">
						<div class="img_container">
							<img class="card-img-top img-responsive" src="data:image/jpg/png/jpeg;base64,<?php echo base64_encode($e_img); ?>" alt="<?php echo $e_name; ?>" />
						</div>
			        	<div class="card-block">
			        		<div class="card-title text-info h4">
			        			<?php echo $e_name; ?>
			        		</div>		        
			        		<div class="h5">
			        			Date: <?php echo $date; ?>
			        		</div>
			        		<div class="h5">
			        			Time: <?php echo $time1; ?>
			        		</div>
		        		</div>
			      	</article>
			      	<?php
			     	 	}else{
			     	 		?>
			     	 			<div class="card animated fadeInLeft">
									<div class="img_container">
										<img class="card-img-top img-responsive" src="img/300x400.png" alt="placeholder" />
									</div>
									<div class="card-block">
										<div class="card-title text-info h4">
											<!-- ** Title Here ** -->
										</div>		        
										<div class="h4" style="text-align: justify !important;">
											<!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of -->
										</div>
										<div class="h4 text-success">
											<!-- ** Note here ** -->
										</div>
									</div>
								</div>
			     	 		<?php
			      		}
			      	?>
			    </div>
			    <div class="col-xs-6 col-md-6 col-lg-6 text-center">
			    	<div class="form_main">
			    		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
						    <div class="form-group">
						        <div class="h2 t-shadow">USN</div>
						        <input type="text" name="id" class="form-control usn_input" placeholder="" value="" autofocus="autofocus">
						    </div>    
						</form>
			    	</div>
			    	<div class="in_out_status t-shadow">
			    		<div class="status_block h1 inout">
			    			<?php
								if ($d_status == "OUT") {
								    echo "<span class='text-danger animated flash'>OUT</span>";
								} elseif ($d_status == "IN") {
								    echo "<span class='text-success animated flash'>IN</span>";
								} else {
								    echo "___";
								}
							?>
			    		</div>
			    	</div>
			    	<div class="in_out_status t-shadow">
			    		<div class="status_block msg">
			    			<span class="msgs state">
							<?php
								if ($msg == "1") {
									?> <span class="animated flash"> <?php 
								    echo "<span class='text-primary'>Welcome to ".$_SESSION['loc'].".<br>Your USN is: " . $usn . "<br>Entry time is: " . date('g:i A', strtotime($time))."</span>";
								    ?> </span> <?php
								} elseif ($msg == "2") {
								    # code...
								    ?> <span class="animated flash"> <?php 
								    echo "<span class='text-warning'>You just Checked In.<br> Wait for 10 Seconds to Check Out.</span>";
								    ?> </span> <?php
								} elseif ($msg == "3") {
								    # code...
								    ?> <span class="animated flash"> <?php 
								    echo "<span class='text-danger'>Invalid USN number.<br> Contact Librarian for more details.</span>";
								    ?> </span> <?php
								} elseif ($msg == "4") {
								    # code...
								    ?> <span class="animated flash"> <?php 
								    echo "<span class='text-success'>Thank you.</span><br>Your Exit time is: " . date('g:i A', strtotime($time)) . "<br><span class='text-warning'>Total Time Duration : ".$otime[0]."</span>";
								    ?> </span> <?php
								} else {
									?> <div class="animated pulse infinite"> <?php 
								    echo "<span class='text-info'>SCAN YOUR ID CARD.</span>";
								     ?> </div> <?php
								}
							?>
							</span>
						</div>
			    	</div>
			    </div>
			    <div class="col-xs-3 col-md-3 col-lg-3">
			    	<a href="logout.php">
				    	<div id="clockdate">
							<div class="clockdate-wrapper">
								<div id="clock"></div>
								<div id="date"></div>
							</div>
						</div>
					</a>
					<div class="in_out_status">
						<div class="status_block h1 stats ">
							<table class="stat_table">
								<tr>
									<span class="msgs">
										<td class="tat">#Inside</td><td> <?php echo $tin[0]; ?></td>
									</span>
								</tr>
								<tr>
									<span class="msgs">
										<td class="tat">#Staff</td><td> <?php echo $staff[0]; ?></td>
									</span>
								</tr>
								<tr>
									<span class="msgs">
										<td class="tat">#Male</td><td> <?php echo $male[0]; ?></td>
									</span>
								</tr>
								<tr>
									<span class="msgs">
										<td class="tat">#Female</td><td> <?php echo $female[0]; ?></td>
									</span>
								</tr>
								<tr>
									<span class="msgs">
										<td class="tat">#Visit</td><td> <?php echo $visit[0]; ?></td>
									</span>
								</tr>
							</table>
						</div>
					</div>
			    </div>
			</div>
		</section>
		<footer class="foot" style="text-align: center; padding-top: 14px;">
            Designed By <a target="_blank" href="https://omkar2403.github.io/its_me/" style="color: pink;">Omkar Kakeru</a><br>
             Powered By <a target="_blank" href="https://www.koha-community.org/" style="color: pink;`">Koha Community</a>
            <!-- blank -->
        </footer>
		<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
		<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>                       
		<script src="assets/js/clock.js"></script>
		<script type="text/javascript">
			$('article').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			  $('article').addClass('delay fadeOutLeft');
			  $('.blank-card').empty().append("")
			});
			$('span').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			  	$('span').addClass('delay fadeOut');
			  	setTimeout(function(){
					$(".status_block .state").empty().append("<div class='animated pulse infinite'><span class='text-info'>SCAN YOUR ID CARD.</span></div>");
					$(".inout").empty().append("___");
				}, 5200);
				setTimeout(function(){
					window.location.replace("/inout/index.php");
				}, 5700);
			});
		</script>
	</body>
</html>
