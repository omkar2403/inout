<?php
	session_start();
	$_SESSION['id']=NULL;
	$_SESSION['loc']=NULL;
	echo "<script>window.location = 'login.php'</script>";
?>
