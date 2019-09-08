<?php
	session_start();
	// ob_start(ob_gzhandler);
	$title = "Edit Role";
	$acc_code = "A02";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-6 ml-auto mr-auto">
	    	<?php
	    	if(isset($_GET['editrole'])) {
	    		$res = getDataById($conn, "roles", $_GET['editrole']);
				$row = mysqli_fetch_array($res);
				$section = explode(';',$row[3]);
			?>
	    	<div class="card">
	          	<div class="card-header card-header-rose card-header-icon">
	              	<div class="card-icon">
	                	<i class="material-icons">edit</i>
	              	</div>
	              	<h4 class="card-title">Edit Role</h4>
	          	</div>
	          	<div class="card-body">
	            	<form name="form5" action="process/admin/usr_process.php" method="POST">
	              		<div class="form-group bmd-form-group">
	                      	<label class="bmd-label-floating">Role</label>
	                      	<input type="text" class="form-control" name="role" value="<?php echo $row[1]; ?>" required="" autofocus="">
	                  	</div>
	                  	<div class="form-group bmd-form-group">
	                      	<label class="bmd-label-floating">Descripton</label>
	                      	<!-- <input type="text" class="form-control" name="fname"> -->
	                      	<textarea class="form-control" rows="3" required="" name="r_desc"><?php echo $row[2]; ?></textarea>
	                  	</div>
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-12">
	                  			<h3>Administration</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="S01" <?php if(in_array("S01",$section)) { ?> checked="checked" <?php } ?> > Setup
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="A02" <?php if(in_array("A02",$section)) { ?> checked="checked" <?php } ?> > User Management
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="R01" <?php if(in_array("R01",$section)) { ?> checked="checked" <?php } ?> > Reports
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                  <div class="col-md-6 col-sm-12">
			                  	<h3>&nbsp;</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="N01" <?php if(in_array("N01",$section)) { ?> checked="checked" <?php } ?> > Notice
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="U02" <?php if(in_array("U02",$section)) { ?> checked="checked" <?php } ?> > Today
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="U03" <?php if(in_array("U03",$section)) { ?> checked="checked" <?php } ?> > Register
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                </div>
	                  	<div class="row">
	                  		<div class="col-md-6 col-sm-12">
	                  			<h3>Admission</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="R01" <?php if(in_array("R01",$section)) { ?> checked="checked" <?php } ?> >  Admission
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
              	</div>
              </div>
              <div class="col-md-6 col-sm-12">
          			<h3>Doctor</h3>
              	<div class="form-group bmd-form-group">
              		<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D01" <?php if(in_array("D01",$section)) { ?> checked="checked" <?php } ?> > Doctor Dashboard
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D02" <?php if(in_array("D02",$section)) { ?> checked="checked" <?php } ?> > Medicine
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D03" <?php if(in_array("D03",$section)) { ?> checked="checked" <?php } ?> > OPD Register
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D04" <?php if(in_array("D04",$section)) { ?> checked="checked" <?php } ?> > IPD Register
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D05" <?php if(in_array("D05",$section)) { ?> checked="checked" <?php } ?> > Search Patient
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="D02" <?php if(in_array("D02",$section)) { ?> checked="checked" <?php } ?> > Employee Management
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                </div>
			                <div class="row">
	                  		<div class="col-md-6 col-sm-12">
	                  			<h3>Services</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="B01" <?php if(in_array("B01",$section)) { ?> checked="checked" <?php } ?> > Department Management
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                  <div class="col-md-6 col-sm-12">
	                  			<h3>Inventory</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="G01" <?php if(in_array("G01",$section)) { ?> checked="checked" <?php } ?>> Inventory Panel
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="G02" <?php if(in_array("G02",$section)) { ?> checked="checked" <?php } ?> > Store Management
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="G03" <?php if(in_array("G03",$section)) { ?> checked="checked" <?php } ?> > Store Access
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                </div>
			                <div class="row">
	                  		<div class="col-md-6 col-sm-12">
	                  			<h3>Insurance</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value="F01" <?php if(in_array("B01",$section)) { ?> checked="checked" <?php } ?> > Manage Insurance
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                  <div class="col-md-6 col-sm-12">
	                  			<h3>Accounts</h3>
			                  	<div class="form-group bmd-form-group">
			                     	<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
									<div class="form-check">
									  <label class="form-check-label">
									    <input class="form-check-input" type="checkbox" name="code[]" value=""> First Checkbox
									    <span class="form-check-sign">
									      <span class="check"></span>
									    </span>
									  </label>
									</div>
			                  	</div>
			                  </div>
			                </div>
	                  	<div class="row">
	                    	<div class="col-md-12">
	                    		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
	                      		<button class="btn btn-success" name="editRole" type="submit">Modify</button>
	                      		<a class="btn btn-danger" href="user_mgnt.php">Cancel</a>
	                    	</div>
	                  	</div>
	           		</form>
	          	</div>
	        </div>
	        <?php
	        }else{
	        	// header('location:index.php');
	        }
	        ?>
	    </div>
	  </div>              
	</div>
	<?php
		if($_GET['msg']==1){
			echo "<script type='text/javascript'>showNotification('top','right','Please select atleast one section', 'warning');</script>";
		}
	?>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	ob_end_flush();
?>