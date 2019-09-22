<?php
	session_start();
	// ob_start(ob_gzhandler);
	$title = "Reports";
	$acc_code = "";
	// $acc_code = "R01";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
	require "functions/general.php";	
	if(isset($_POST['slib'])){
    $_SESSION["lib"] = $_POST['slib'];
    header("location:reports.php");
  }
  $slib = $_SESSION['loc'];
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	  	<?php
        if($_SESSION['id']=="Master"){
      ?>
      	<div class="col-md-3">
		    	<div class="card">
		        <div class="card-header card-header-icon card-header-rose">
		          <div class="card-icon">
		            <i class="material-icons">map</i>
		          </div>
		          <h4 class="card-title">Location</h4>
		        </div>
		        <div class="card-body">
		          <form action="" method="POST" name="rep1">
		            <div class="row">
		            	<div class="col-md-12">
		                <div class="form-group">
		                  <select name="slib" class="selectpicker" data-style="select-with-transition" title="<?php echo $slib; ?>" onchange="this.form.submit();">
                          <?php
                              echo "<option>".$slib."</option>";
                              $query = "SELECT * FROM `loc`";
                              $res = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error($conn));
                              while($row=mysqli_fetch_array($res)){
                                  echo "<option>".$row['1']."</option>";
                              }
                              echo "<option>Master</option>";
                          ?>
                      </select>
		                </div>
		              </div>
		            </div>
		          </form>
		        </div>
		      </div>
		    </div>
      <?php
    		}	
      ?>
	    <div class="col-md-3">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-rose">
	          <div class="card-icon">
	            <i class="material-icons">calendar_today</i>
	          </div>
	          <h4 class="card-title">Datewise Reports</h4>
	        </div>
	        <div class="card-body">
	          <form action="report.php" method="POST" name="rep1">
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control datepicker" placeholder="Date From" name="fdate">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" name="tdate" placeholder="Date To"  class="form-control datepicker">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control timepicker" placeholder="Time From"  name="ftime">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" name="ttime" class="form-control timepicker" placeholder="Time To" >
	                </div>
	              </div>
	            </div>
	            <input type="submit" value="Submit" name="datewiseRep" class="btn btn-success">
	            <input type="reset" value="Clear" class="btn btn-warning">
	          </form>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-3">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-rose">
	          <div class="card-icon">
	            <i class="material-icons">perm_identity</i>
	          </div>
	          <h4 class="card-title">Studentwise Reports</h4>
	        </div>
	        <div class="card-body">
	          <form action="report.php" method="POST" name="rep2">
	          	<div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="USN"  name="usn">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control datepicker" placeholder="Date From" name="fdate">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" name="tdate" placeholder="Date To"  class="form-control datepicker">
	                </div>
	              </div>
	            </div>
	            <div class="row">
		            <div class="col-md-12">
		            	<div class="form-check">
	                  <label class="form-check-label">
	                    <input class="form-check-input" type="radio" name="rtype" checked="" value="Short"> Short Report
	                    <span class="form-check-sign">
	                      <span class="check"></span>
	                    </span>
	                  </label>
	                </div>
	                <div class="form-check">
	                  <label class="form-check-label">
	                    <input class="form-check-input" type="radio" name="rtype" value="Detail"> Detailed Report
	                    <span class="form-check-sign">
	                      <span class="check"></span>
	                    </span>
	                  </label>
	                </div>
		            </div>
		          </div>
	            <input type="submit" value="Submit" name="studentRep" class="btn btn-success">
	            <input type="reset" value="Clear" class="btn btn-warning">
	          </form>
	        </div>
	      </div>
    	</div>
	    <div class="col-md-3">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-rose">
	          <div class="card-icon">
	            <i class="material-icons">list</i>
	          </div>
	          <h4 class="card-title">Statistical Reports</h4>
	        </div>
	        <div class="card-body">
	          <form action="report.php" method="POST" name="rep3">
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control datepicker" placeholder="Date From" name="fdate">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" name="tdate" placeholder="Date To"  class="form-control datepicker">
	                </div>
	              </div>
	            </div>
	            <input type="submit" value="Submit" name="statRep" class="btn btn-success">
	            <input type="reset" value="Clear" class="btn btn-warning">
	          </form>
	        </div>
	      </div>
	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	// ob_end_flush();
?>