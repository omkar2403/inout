<?php
	$host = "112.133.197.201";
	$user = "root";
	$password = "mysqlroot";
	$d_koha = "koha_library";
	$link1 = mysql_connect($host, $user, $password);
	if (!$link1) {
	    die("Not connected: " . mysql_error());
	} else {
	    mysql_select_db($d_koha, $link1);
	    echo "Connected";
	}
?>