<?php

$host = "localhost";
$user = "root";
$password = "root";
$d_koha = "koha_library";
$d_entry = "lib";
$link1 = mysql_connect($host, $user, $password);
if (!$link1) {
    die("Not connected: " . mysql_error());
} else {
    mysql_select_db($d_koha, $link1);
}
$link2 = mysql_connect($host, $user, $password, TRUE);
if (!$link2) {
    die("Not connected: " . mysql_error());
} else {
    mysql_select_db($d_entry, $link2);
}

$query = "SELECT value FROM `setup` where var='cname'";
$result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
$cname = mysql_fetch_row($result);

$query = "SELECT value FROM `setup` where var='cc'";
$result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
$cc = mysql_fetch_row($result);

$query = "SELECT value FROM `setup` where var='libtime'";
$result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
$libtime = mysql_fetch_row($result);
?>
