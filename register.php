<?php
	session_start();
	$title = "Entry Register";
	$acc_code = "U03";
	$slib = $_SESSION['loc'];
	$table = true;
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
	    <div class="col-md-12">
	    	<div class="card">
				  <div class="card-header card-header-info card-header-icon">
				    <div class="card-icon">
				      <i class="material-icons">assignment</i>
				    </div>
				    <h4 class="card-title">Entry Register</h4>
				  </div>
				  <div class="card-body">
				  	<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
			        <thead>
			          <tr>
			          	<th>Sl</th>  
                  <th>USN</th>  
                  <th>Name</th> 
                  <th>Email</th> 
                  <th>Mobile</th>
                  <th>Date</th>
                  <th>Entry</th>
                  <th>Exit</th>
			          </tr>
			        </thead>
			        <tbody>
			        	<?php
			        		$date = date('d-m-Y');
			        		echo "<script type='text/javascript'>var printMsg = '".$_SESSION['lib']." Entry Register for ".$slib." Recent 500 entries Inout System Data'; </script>";
			        		$date = date('Y-m-d');
                  $sql = "SELECT *  FROM `inout` where `loc` = '$slib' ORDER BY sl DESC LIMIT 500";
                  $result = mysqli_query($conn, $sql) or die("Invalid query: " . mysqli_error($conn));
                  while ($row = mysqli_fetch_array($result)) {
                ?>
                	<tr>
                		<td><?php echo $row['sl']; ?></td>
                    <td><?php echo $row['cardnumber']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mob']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                  	<td><?php echo $row['entry']; ?></td>
                  	<td><?php echo $row['exit']; ?></td>
                  </tr>
                <?php
                  } 
			        	?>
			        </tbody>
			        <tfoot>
		            <tr>
	                <th></th>
	                <th></th>
	                <th></th>
	                <th></th>
	                <th></th>
	                <th></th>
	                <th></th>
	                <th></th>
		            </tr>
		        	</tfoot>
			      </table>
				  </div>
				</div>
	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
?>