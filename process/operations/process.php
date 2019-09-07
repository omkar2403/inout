<?php
	require '../../functions/dbconn.php';
	require '../../functions/general.php';

	if(isset($_POST['basic'])){
    $ccname = $_POST['cname'];
    $query = "UPDATE `setup` SET `value` = '$ccname' WHERE `setup`.`var` = 'cname'";
    $result = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error());

    $libtime = $_POST['libtime'];
    $query = "UPDATE `setup` SET `value` = '$libtime' WHERE `setup`.`var` = 'libtime'";
    $result = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error());

    if($result){
    	header("location:../../setup.php?msg=1");
    }
  }

  if(isset($_POST['location'])){
    $loc = $_POST['loc'];
    $sl = getsl($conn, "id", "loc");
    $query = "INSERT INTO `loc` VALUES('".$sl."', '".$loc."');";
    $result = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error());

    if($result){
    	header("location:../../setup.php?msg=2");
    }
  }

?>