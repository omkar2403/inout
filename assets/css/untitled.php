<?php
if(isset($_POST['pass'])){
$user=trim($_POST['name']);
$pass=trim($_POST['pass']);
$user = mysql_real_escape_string($user);
$pass = mysql_real_escape_string($pass);
$loc=$_POST['loc'];
$query="SELECT * FROM log WHERE user='$user' AND pass='$pass'";
$result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
$row = mysql_fetch_row($result);
if($loc != "Master"){
if($row[2]=="admin"){
$_SESSION["id"]=$row['2'];
$_SESSION["loc"]=$loc;
$_SESSION["lib"]=$loc;
echo "<script>window.location = 'admin.php'</script>";
}elseif ($row['2']=="user") {
$_SESSION["id"]=$row['2'];
$_SESSION["loc"]=$loc;
echo "<script>window.location = 'index.php'</script>";
}else{
echo "<script type='text/javascript'>alert(\"Wrong Username/Password\");</script>";
}
}else if($loc=="Master"){
if ($row['2']=="superuser" && $user=="master") {
$_SESSION["id"]=$row['2'];
$_SESSION["loc"]="Master";
$_SESSION["lib"]="Master";
echo "<script>window.location = 'admin.php'</script>";
}
}
}
?>