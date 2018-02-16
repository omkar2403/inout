<?php 

      $loc = $_SESSION['loc'];
      $date = date('Y-m-d');
      $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and loc='$loc'";
      $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
      $visit = mysql_fetch_row($result);
      $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and gender='M' and status='IN' and loc='$loc'";
      $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
      $male = mysql_fetch_row($result);
      $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and gender='F' and status='IN' and loc='$loc'";
      $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
      $female = mysql_fetch_row($result);
      $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and status='IN' and loc='$loc'";
      $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
      $tin = mysql_fetch_row($result);
      $query = "SELECT count(sl) FROM `inout` WHERE date='$date' and status='IN' and loc='$loc' and cc='$cc[0]'";
      $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
      $staff = mysql_fetch_row($result);
?>