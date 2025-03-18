<?php
	session_start();
	$title = "User Management";
	$acc_code = "A02";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
	require "functions/dbconn.php";
	require "functions/dbfunc.php";
?>
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
		<div class="row">
		  	<div class="col-lg-2 col-md-2">
		    	<ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
		      		<li class="nav-item">
		        		<a class="nav-link active show" data-toggle="tab" href="#usr1" role="tablist">
		          			<i class="material-icons">face</i> Users
		        		</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" data-toggle="tab" href="#usr2" role="tablist">
		          			<i class="material-icons">schedule</i> Roles
		        		</a>
		      		</li>
		    	</ul>
		  	</div>
		  	<div class="col-md-10">
		    	<div class="tab-content">
		      		<div class="tab-pane active show" id="usr1">
		      			<div class="row">
		      				<div class="col-md-8 col-sm-12">
		      					<div class="card">
								  	<div class="card-header card-header-rose card-header-icon">
								    	<div class="card-icon">
								      		<i class="material-icons">assignment</i>
								    	</div>
								    	<h4 class="card-title">User List</h4>
								  	</div>
								  	<div class="card-body">
								    	<div class="table-responsive">
								      		<table class="table">
								        		<thead>
								          			<tr>
											            <th class="text-center">ID</th>
											            <th>Username</th>
											            <th>Name</th>
											            <th>Role</th>
											            <th>Active</th>
											            <th class="text-left">Actions</th>
								          			</tr>
								        		</thead>
								        		<tbody>
								        			<?php
								        				$n = 0;
								        				$res = getData($conn, "users");
								        				foreach ($res as $user) {
								        					$n++;
								        			?>
									          		<tr>
											            <td class="text-center"><?php echo $user['id']; ?></td>
											            <td><?php echo $user['username']; ?></td>
											            <td><?php echo $user['fname']; ?></td>
											            <td><?php $res = getDataById($conn, "roles", $user['role']); 
											            					$row = mysqli_fetch_array($res);
											            	 				echo $row['rname'];
											            	 		?></td>
											            <td><?php if(!$user['active']) {echo 'No'; }else{ echo 'Yes';} ?></td>
											            <td class="text-center td-actions">
												            <a rel="tooltip" href="edit_user.php?edituser=<?php echo $user['id']; ?>" class="btn btn-success btn-link" title="Edit">
												              <i class="material-icons">edit</i>
												            </a>
												            <?php
												            	if($n > 3){
												            ?>
												            <a rel="tooltip" href="process/admin/usr_process.php?deluser=<?php echo $user['id']; ?>" class="btn btn-danger btn-link" title="Delete">
												              <i class="material-icons">close</i>
												            </a>
												            <?php
												          		}
												          	?>
											            </td>
									          		</tr>
									          		<?php
									          			}
									          		?>
								        		</tbody>
								      		</table>
								    	</div>
								  	</div>
								</div>
		      				</div>
		      				<div class="col-md-4 col-sm-12">
						        <div class="card">
						          	<div class="card-header card-header-rose card-header-icon">
						              	<div class="card-icon">
						                	<i class="material-icons">face</i>
						              	</div>
						              	<h4 class="card-title">Add User</h4>
						          	</div>
						          	<div class="card-body">
						            	<form name="form4" action="process/admin/usr_process.php" method="POST">
						              		<div class="form-group bmd-form-group">
						                      	<label class="bmd-label-floating">Username</label>
						                      	<input type="text" class="form-control" name="username" required="" autofocus="">
						                  	</div>
						                  	<div class="form-group bmd-form-group">
						                      	<label class="bmd-label-floating">Full Name</label>
						                      	<input type="text" class="form-control" required="" name="fname">
						                  	</div>
						                  	<div class="form-group bmd-form-group">
						                      	<label class="bmd-label-floating">Password</label>
						                     	<input type="password" class="form-control" required="" name="password">
						                  	</div>
						                  	<div class="form-group bmd-form-group">
						                     	<div class="dropdown bootstrap-select">
							                    	<select class="selectpicker" data-style="select-with-transition" title="Choose Role" data-size="7" tabindex="-98" required=""  name="role">
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
						                      		<button class="btn btn-success" name="addUser" type="submit">Add</button>
						                      		<button class="btn btn-danger" type="reset">Clear</button>
						                    	</div>
						                  	</div>
						           		</form>
						          	</div>
						        </div>
						    </div>
		      			</div>
		    		</div>
		    		<div class="tab-pane" id="usr2">
		    			<div class="row">
		      				<div class="col-md-6 col-sm-12">
		      					<div class="card">
								  	<div class="card-header card-header-rose card-header-icon">
								    	<div class="card-icon">
								      		<i class="material-icons">assignment</i>
								    	</div>
								    	<h4 class="card-title">Roles</h4>
								  	</div>
								  	<div class="card-body">
								    	<div class="table-responsive">
								      		<table class="table">
								        		<thead>
								          			<tr>
											            <th class="text-center">ID</th>
											            <th>Role</th>
											            <th>Description</th>
											            <!-- <th class="text-left">Actions</th> -->
								          			</tr>
								        		</thead>
								        		<tbody>
								        			<?php
								        				$res = getData($conn, "roles");
								        				foreach ($res as $role) {
								        			?>
									          		<tr>
											            <td class="text-center"><?php echo $role['id']; ?></td>
											            <td><?php echo $role['rname']; ?></td>
											            <td><?php echo $role['rdesc']; ?></td>
											            <!-- <td class="text-center td-actions">
												            <a rel="tooltip" href="edit_role.php?editrole=<?php echo $role['id']; ?>" class="btn btn-success btn-link" title="Edit">
												              <i class="material-icons">edit</i>
												            </a>
												            <a rel="tooltip" href="process/admin/usr_process.php?delrole=<?php echo $role['id']; ?>" class="btn btn-danger btn-link" title="Delete">
												              <i class="material-icons">close</i>
												            </a>
											            </td> -->
									          		</tr>
									          		<?php
									          			}
									          		?>
								        		</tbody>
								      		</table>
								    	</div>
								  	</div>
								</div>
		      				</div>
		      			</div>
			      	</div>
		  		</div>
			</div>   
		</div>              
	</div>
	<?php
		if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
  
      if ($msg == 1) {
          echo "<script type='text/javascript'>showNotification('top','right','Please select at least one section!', 'warning');</script>";
      }
      if ($msg == 2) {
          echo "<script type='text/javascript'>showNotification('top','right','Role Added Successfully', 'success');</script>";
      }
      if ($msg == 3) {
          echo "<script type='text/javascript'>showNotification('top','right','Role Deleted Successfully', 'danger');</script>";
      }
      if ($msg == 4) {
          echo "<script type='text/javascript'>showNotification('top','right','Role Updated Successfully', 'info');</script>";
      }
      if ($msg == 5) {
          echo "<script type='text/javascript'>showNotification('top','right','User Added Successfully', 'success');</script>";
      }
      if ($msg == 6) {
          echo "<script type='text/javascript'>showNotification('top','right','User Updated Successfully', 'info');</script>";
      }
      if ($msg == 7) {
          echo "<script type='text/javascript'>showNotification('top','right','User Deleted Successfully', 'danger');</script>";
      }
      if ($msg == 8) {
          echo "<script type='text/javascript'>showNotification('top','right','Duplicate Username!', 'warning');</script>";
      }
      if ($msg == 9) {
          echo "<script type='text/javascript'>showNotification('top','right','Duplicate Role Name!', 'warning');</script>";
      }
  }
  
	?>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	ob_end_flush();
?>