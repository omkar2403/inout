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
    if (isset($_GET['msg']) && isset($_SESSION['user_name'])) {
        $msg = htmlspecialchars($_GET['msg']); // Prevent XSS attacks
        $user_name = htmlspecialchars($_SESSION['user_name']); // Sanitize session data
    
        switch ($msg) {
            case "Evening":
                echo "<script type='text/javascript'>showNotification('top','right','Good Evening $user_name', 'info');</script>";
                break;
            case "Morning":
                echo "<script type='text/javascript'>showNotification('top','right','Good Morning $user_name', 'info');</script>";
                break;
            case "Noon":
                echo "<script type='text/javascript'>showNotification('top','right','Good Afternoon $user_name', 'info');</script>";
                break;
            default:
                // Optional: Handle unknown values
                echo "<script type='text/javascript'>showNotification('top','right','Hello $user_name', 'info');</script>";
                break;
        }
    }
	require_once "./template/footer.php";
	ob_end_flush();
?>