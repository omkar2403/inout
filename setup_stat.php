<?php 
    include 'dbconn.php';

    $query = "SELECT pass FROM `log` where user='admin'";
    $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
    $apass = mysql_fetch_row($result);

    $query = "SELECT pass FROM `log` where user='user'";
    $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
    $upass = mysql_fetch_row($result);

    $query = "SELECT value FROM `setup` where var='cc'";
    $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
    $cc = mysql_fetch_row($result);
?>