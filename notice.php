<?php
	session_start();
	$title = "Notice";
	$acc_code = "N01";
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
	    <div class="col-md-4">
	    	<div class="card">
	        <div class="card-header card-header-icon card-header-rose">
	          <div class="card-icon">
	            <i class="material-icons">perm_identity</i>
	          </div>
	          <h4 class="card-title">Notice Setup -
	            <small class="category">In Out System</small>
	          </h4>
	        </div>
	        <div class="card-body">
	          <form action="process/operations/process.php" method="POST" name="news">
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">Notice Title</label>
	                  <input type="text" class="form-control" maxlength="50" autofocus="true" name="nhead">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">Notice Body</label>
	                  <textarea type="textarea" rows = "12" name="nbody" maxlength="570" class="form-control"></textarea>
	                </div>
	              </div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	                <div class="form-group">
	                  <label class="bmd-label-floating">Notice Footer</label>
	                  <input type="text" class="form-control" maxlength="50" autofocus="true" name="nfoot">
	                </div>
	              </div>
	            </div>
	            <div class="row">
	              <div class="col-md-12">
	                <div class="form-group">
	                  <div class="form-group">
								      <select autofocus="true" list="location" name="loc" data-style="btn btn-outline " class="col-md-5 selectpicker form-control" tabindex="-1" title="Select Location" required>
								        <?php
								          $result = getData($conn, "loc");
								          while ($row = mysqli_fetch_array($result)) {
								            echo '<option value="'.$row['loc'].'">'.$row['loc'].'</option>';
								          }
								        ?>                                               
								      </select>
								    </div>
							    </div>
							  </div>
							</div>
	            <input type="submit" value="Submit" name="addnews" class="btn btn-success">
	            <input type="reset" value="Clear" class="btn btn-warning">
	          </form>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-8">
	    	<div class="card ">
				  <div class="card-header ">
				    <h4 class="card-title">Notices</h4>
				  </div>
				  <div class="card-body chat ">
						<div class="chatbox">
							<?php
					    	$note = getNews($conn);
					    	while($row = mysqli_fetch_array($note)){
					    		echo "<div class='chat_container chat_darker'>
							  <p class='chat_p'><b style='font-size: 16px;'>".$row['nhead']."<br></b>".$row['nbody']."<br><b style='font-size: 16px;'>".$row['nfoot']."</b></p> Published On: ".$row['edate']."<br>Location: ".$row['loc']."
							  <span class='chat_time-right'>Active: <a class='btn btn-sm btn-info' href='process/operations/process.php?nid=".$row['id']."&status=".$row['status']."&loc=".$row['loc']."'>".$row['status']."</a></span></div>";
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
  if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];

    if ($msg == 1) {
      echo "<script type='text/javascript'>showNotification('top','right','Notice Added and Activated', 'success');</script>";
    } elseif ($msg == 2) {
      echo "<script type='text/javascript'>showNotification('top','right','Status Updated', 'success');</script>";
    }
  }

  require_once "./template/footer.php";
?>
