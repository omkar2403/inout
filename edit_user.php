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
	  	<div class="col-md-12">
	    	<div class="col-md-6 ml-auto mr-auto">
	    		<div class="card">
					  <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">Edit User</h4>
          	</div>
					  <div class="card-body">
				    	<?php
				    		if(isset($_GET['edituser'])) {
				    			$res = getDataById($conn, "users", $_GET['edituser']);
								$row = mysqli_fetch_array($res);
							?>
							<form name="form4" action="process/admin/usr_process.php" method="POST">
		        		<div class="form-group bmd-form-group">
		                	<label class="bmd-label-floating">Username</label>
		                	<input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" autofocus="">
	            	</div>
	            	<div class="form-group bmd-form-group">
	                	<label class="bmd-label-floating">Full Name</label>
	                	<input type="text" class="form-control" value="<?php echo $row['fname']; ?>" name="fname">
	            	</div>
	            	<div class="form-group bmd-form-group">
	                	<label class="bmd-label-floating">New Password</label>
	                	<input type="password" class="form-control" name="pass">
	            	</div>
	            	<label class="bmd-label">Active</label>
	            	<div class="form-group bmd-form-group">
			            <div class="form-check">
			              <label class="form-check-label">
			                <input class="form-check-input" type="radio" name="active" value="1" <?php if($row['active']) { echo 'checked';}?> > Yes
			                <span class="circle">
			                  <span class="check"></span>
			                </span>
			              </label>
			            </div>
			            <div class="form-check">
			              <label class="form-check-label">
			                <input class="form-check-input" type="radio" name="active" value="0"  <?php if(!$row['active']) { echo 'checked';}?>> No
			                <span class="circle">
			                  <span class="check"></span>
			                </span>
			              </label>
			            </div>
		          	</div>
	            	<div class="form-group bmd-form-group">
	               	<div class="dropdown bootstrap-select">
	                  	<select class="selectpicker" data-style="select-with-transition" data-size="7" tabindex="-98" name="role">
	                  		<option value="<?php echo $row['role']; ?>">Current Role</option>
	                  		<?php
	                  			$roles = getData($conn, "roles");
	                  			foreach($roles as $rname) {
	                  				echo "<option value='".$rname['id']."'>".$rname['rname']."</option>";
	                  			}
	                  		?>
	                      </select>
	          			</div>
	            	</div>
	            	<div class="row">
	              	<div class="col-md-12">
	              		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
	                		<button class="btn btn-success" name="editUser" type="submit">Update</button>
	                		<a class="btn btn-danger" href="user_mgnt.php">Cancel</a>
	              	</div>
	            	</div>
	     				</form>
			     		<?php
			     			}
			     		?>
			     	</div>
		    	</div>
	  		</div>  
	  	</div>  
	  </div>          
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	ob_end_flush();
?>