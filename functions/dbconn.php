<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db = "inout";
	$koha = "koha_library";
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error($conn));
	}

	$koha = mysqli_connect($servername, $username, $password, $koha);
	if (!$koha) {
	    die("Connection failed: " . mysqli_connect_error($koha));
	}

	function sanitize($conn, $str){
		return mysqli_real_escape_string($conn, $str);
	}
	// var_dump(function_exists('mysqli_connect'));
	date_default_timezone_set("Asia/Kolkata");
?>