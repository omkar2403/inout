<?php

$host = "localhost";
$user = "root";
$password = "root";
$d_koha = "koha_library";
$d_entry = "lib";
$link1 = mysqli_connect($host, $user, $password, $d_koha);
if (!$link1) {
    die("Not connected: " . mysql_error());
} 
$link2 = mysqli_connect($host, $user, $password, $d_entry);
if (!$link2) {
    die("Not connected: " . mysql_error());
}

?>
