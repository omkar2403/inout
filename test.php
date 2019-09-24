<?php
	session_start();
	// ob_start(ob_gzhandler);
	$title = "Dashboard";
	$acc_code = "";
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
	    <div class="col-md-12	">
	    	<?php
	    	$fdate = "2019-09-22";
	    	$tdate = "2019-09-26";
	    	$idate = "2019-09-22";
	    	

	    	do{
	    		$sql = "SELECT DISTINCT date, DAYNAME('$idate') FROM `inout` WHERE `date` = '$idate'";
        	$result = mysqli_query($conn, $sql) or die("Invalid query1: " . mysqli_error($conn));
	    		$outer = mysqli_fetch_row($result);

	    		if($outer){
	    			$sql2 = "INSERT INTO `tmp3` VALUES ('$outer[0]','$outer[1]','','','')";
	    			$result2 = mysqli_query($conn, $sql2) or die("Invalid query2: " . mysqli_error($conn));

	    			$n = 1;
		    		$query = "SELECT * FROM `loc`";
	          $res = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error($conn));
	          while($row=mysqli_fetch_array($res)){

	          	$sql3 = "INSERT INTO `tmp3` VALUES ('','','$row[1]','','')";
		    			$result3 = mysqli_query($conn, $sql3) or die("Invalid query2: " . mysqli_error($conn));

			        $sql1 = "SELECT cc, count(sl) FROM `inout` WHERE `date` = '$idate' AND `loc`='$row[1]' GROUP BY cc";
			        $result1 = mysqli_query($conn, $sql1) or die("Invalid query5: " . mysqli_error($conn));
			        while($inner = mysqli_fetch_array($result1)){
			        	$sql2 = "INSERT INTO `tmp3` VALUES ('','','','$inner[0]','$inner[1]')";
			    			$result2 = mysqli_query($conn, $sql2) or die("Invalid query2: " . mysqli_error($conn));
			        }
	        	}
	    		}

          $idate=date_create("$idate");
          date_add($idate,date_interval_create_from_date_string("1 days"));
          $idate = date_format($idate,"Y-m-d");
        }while ($idate<=$tdate);


	    	?>
	    	<table>
	    		<thead>
	    			<th>Date</th>
	    			<th>Category</th>
	    			<th>Count</th>
	    		</thead>
	    		<tbody>
	    			<tr>
	    				<td></td>
	    				<td></td>
	    				<td></td>
	    			</tr>
	    		</tbody>
	    	</table>
	    </div>
	  </div>              
	</div>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
	require_once "./template/footer.php";
	// ob_end_flush();
?>	