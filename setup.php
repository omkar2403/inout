<?php
	session_start();
	$title = "Setup";
	$acc_code = "S01";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";	
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-6">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-rose">
	          <div class="card-icon">
	            <i class="material-icons">perm_identity</i>
	          </div>
	          <h4 class="card-title">Basic Setup -
	            <small class="category">In Out System</small>
	          </h4>
	        </div>
	        <div class="card-body">
	        	<?php
	        		$res = setupStats($conn);
	        	?>
	          <form action="process/operations/process.php" method="POST" name="basic">
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">College Name</label>
	                  <input type="text" class="form-control" autofocus="true" value="<?php echo $res[0]; ?>" name="cname">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">Library Closing Time (HH:MM:SS) (24-Hours Format)</label>
	                  <input type="text" name="libtime" class="form-control" value="<?php echo $res[1]; ?>">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">What do you call your Univercity Number</label>
	                  <input type="text" name="noname" class="form-control" value="<?php echo $res[2]; ?>">
	                </div>
	              </div>
	            </div>
	            <input type="submit" value="Submit" name="basic" class="btn btn-success">
	            <input type="reset" value="Clear" class="btn btn-warning">
	          </form>
	        </div>
	      </div>
	      <div class="row">
	      	<div class="col-md-12">
	      		<div class="card">
			        <div class="card-header card-header-icon card-header-primary">
			          <div class="card-icon">
			            <i class="material-icons">done_outline</i>
			          </div>
			          <h4 class="card-title">Add Location -
			            <small class="category">In Out System</small>
			          </h4>
			        </div>
			        <div class="card-body">
			          <form action="process/operations/process.php" method="POST" name="loc">
			            <div class="row">
			            	<div class="col-md-12">
			                <div class="form-group">
			                  <label class="bmd-label-floating">New Location Name</label>
			                  <input type="text" class="form-control" autofocus="true" name="loc">
			                </div>
			              </div>
			            </div>
			            <input type="submit" value="Submit" name="location" class="btn btn-success">
			            <input type="reset" value="Clear" class="btn btn-warning">
			          </form>
			        </div>
			      </div>
	      	</div>
	      	<div class="col-md-12">
	      		<div class="card">
			        <div class="card-header card-header-icon card-header-info">
			          <div class="card-icon">
			            <i class="material-icons">notes</i>
			          </div>
			          <h4 class="card-title">Setup -
			            <small class="category">Main Screen</small>
			          </h4>
			        </div>
			        <div class="card-body">
			          <form action="process/operations/process.php" method="POST" name="updateDash">
			            <div class="row">
			            	<div class="col-md-6 checkbox-radios">
			                <div class="form-check">
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="activedash" value="clock" <?php if($res[4] == "clock") echo "checked"; ?> > Clock
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			                <div class="form-check">
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="activedash" value="newarrivals" <?php if($res[4] == "newarrivals") echo "checked"; ?> > New Arrivals
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			                <div class="form-check">
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="activedash" value="quote" <?php if($res[4] == "quote") echo "checked"; ?> > Quotes
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			              </div>
			              <div class="col-md-6 checkbox-radios">
			                <div class="form-check">
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="banner" value="name" <?php if($res[3] == "false") echo "checked"; ?> > Display Name
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			                <div class="form-check">
			                  <label class="form-check-label">
			                    <input class="form-check-input" type="radio" name="banner" value="banner" <?php if($res[3] == "true") echo "checked"; ?> > Display Banner
			                    <span class="circle">
			                      <span class="check"></span>
			                    </span>
			                  </label>
			                </div>
			              </div>
			            </div>
			            <input type="submit" value="Submit" name="updateDash" class="btn btn-success">
			          </form>
			        </div>
			      </div>
	      	</div>
	      </div>
	    </div>
	    <div class="col-md-6">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-success">
	          <div class="card-icon">
	            <i class="material-icons">view_headline</i>
	          </div>
	          <h4 class="card-title">Information -
	            <small class="category">In Out System</small>
	          </h4>
	        </div>
	        <div class="card-body">
            <div class="row">
            	<div class="col-md-12">
            		<h3>College Name</h3>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h4><?php echo $res[0]; ?></h4>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h3>Library Closing Time</h3>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h4><?php echo $res[1]; ?></h4>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h3>What do you call your Univercity Number?</h3>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h4><?php echo $res[2]; ?></h4>
            	</div>
            </div>
	        </div>
	      </div>
	      <div class="row">
	      	<div class="col-md-12">
	      		<div class="card">
			        <div class="card-header card-header-icon card-header-success">
			          <div class="card-icon">
			            <i class="material-icons">map</i>
			          </div>
			          <h4 class="card-title">Locations -
			            <small class="category">In Out System</small>
			          </h4>
			        </div>
			        <div class="card-body">
		            <?php 
		              $query = "SELECT loc FROM `loc`";
		              $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
		              while($res = mysqli_fetch_array($result)){
		                echo "<div class='row'><div class='col-md-12'><h4>".$res['loc']."</h4></div></div>";
		              }
		            ?>
			        </div>
			      </div>
	      	</div>
	      </div>
	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
  if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];

    if ($msg == "1") {
      echo "<script type='text/javascript'>showNotification('top','right','Basic Information Updated Successfully', 'success');</script>";
    }
    if ($msg == "2") {
      echo "<script type='text/javascript'>showNotification('top','right','Location Added Successfully', 'success');</script>";
    }
  }
	require_once "./template/footer.php";
?>