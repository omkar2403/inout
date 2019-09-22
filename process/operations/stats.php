<?php
  $loc = $_SESSION['loc'];
  $date = date('Y-m-d');
  $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and loc='$loc'";
  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
  $visit = mysqli_fetch_row($result);
  $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and gender='M' and status='IN' and loc='$loc'";
  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
  $male = mysqli_fetch_row($result);
  $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and gender='F' and status='IN' and loc='$loc'";
  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
  $female = mysqli_fetch_row($result);
  $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and status='IN' and loc='$loc'";
  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
  $tin = mysqli_fetch_row($result);
  $query = "SELECT cc, COUNT(sl) FROM `inout` GROUP BY cc;";
  $extraCount = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
?>