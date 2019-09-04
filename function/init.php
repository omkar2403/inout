<?php

require 'dbconn.php';

$query = "SELECT value FROM `setup` where var='cname'";
$result = mysqli_query($link2,$query) or die("Invalid query: " . mysql_error());
$cname = mysqli_fetch_row($result);

$query = "SELECT value FROM `setup` where var='cc'";
$result = mysqli_query($link2,$query) or die("Invalid query: " . mysql_error());
$cc = mysqli_fetch_row($result);

$query = "SELECT value FROM `setup` where var='libtime'";
$result = mysqli_query($link2,$query) or die("Invalid query: " . mysql_error());
$libtime = mysqli_fetch_row($result);

?>