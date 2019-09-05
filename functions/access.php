<?php

	if(!isset($_SESSION['user_id'])){
		header('location:login.php');
		exit();
	}

	$user_access = $_SESSION['user_access'];
	if(!in_array($acc_code, $user_access)){
		header('location:index.php');
	}
?>