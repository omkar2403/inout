<?php
	session_start();
	// ob_start(ob_gzhandler);
	$title = "Dashboard";
	$acc_code = "INDEX";
	require "./functions/access.php";
	require_once "./template/header.php";
	require_once "./template/sidebar.php";
?>
<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
	<div class="container-fluid">
	  <div class="row">
	    <div class="col-md-12">
	       Welcome <?php echo $_SESSION['user_name']; ?>.. 
	    </div>
	  </div>              
	</div>
</div>
<script type="text/javascript">

</script>
<!-- MAIN CONTENT ENDS -->
<?php
    if($_GET['msg']=="Evening"){
      echo "<script type='text/javascript'>showNotification('top','right','Good Evening ".$_SESSION['user_name']."', 'info');</script>";
    }
    if($_GET['msg']=="Morning"){
      echo "<script type='text/javascript'>showNotification('top','right','Good Morning ".$_SESSION['user_name']."', 'info');</script>";
    }
    if($_GET['msg']=="Noon"){
      echo "<script type='text/javascript'>showNotification('top','right','Good After Noon ".$_SESSION['user_name']."', 'info');</script>";
    }
	require_once "./template/footer.php";
	ob_end_flush();
?>