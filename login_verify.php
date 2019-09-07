<?php
	session_start();
	if(!isset($_POST['submit'])){
		header('location:login.php');
		exit;
	}
	require_once "./functions/dbconn.php";
	require_once "./functions/dbfunc.php";

	$name = trim($_POST['name']);
	$pass = trim($_POST['pass']);
	$loc = $_POST['loc'];

	$ftime = strtotime("12:00:00");
	$stime = strtotime("17:00:00");
	$ltime = strtotime(now);

	if($ftime > $ltime){
		$_SESSION['t'] = "Morning";
	}elseif($stime > $ltime){
		$_SESSION['t'] = "Noon";
	}else{
		$_SESSION['t'] = "Evening";
	}

	$name = sanitize($conn, $name);
	$pass = sanitize($conn, $pass);

	$pass = sha1($pass);

	// get from db
	$query = "SELECT * from users where username = '".$name."' and pass = '".$pass."'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Empty data " . mysqli_error($conn);
		exit;
	}
	$user = mysqli_fetch_assoc($result);

	if($name == $user['username'] && $pass == $user['pass'] ){
		if($user['active']==1){
			$role = mysqli_fetch_assoc(getDataById($conn, "roles", $user['role']));
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['user_role'] = $role['rname'];
			$_SESSION['user_access'] = explode(';', $role['acc_code']);

			if($loc != "Master"){
        if($role['rname'] == "Admin"){
          $_SESSION["id"] = $role['rname'];
          $_SESSION["loc"] = $loc;
          $_SESSION["lib"] = $loc;
          header("Location: index.php?msg=".$_SESSION['t']);
        }elseif ($role['rname'] == "User") {
          $_SESSION["id"] = $role['rname'];
          $_SESSION["loc"] = $loc;
          header("Location: user.php");
        }else{
          header('location:login.php?msg=1');
        }
    	}elseif($loc == "Master"){
        if ($role['rname'] == "Master" && $user['username'] == "master") {
          $_SESSION["id"] = $role['rname'];
          $_SESSION["loc"] = "Master";
          $_SESSION["lib"] = "Master";
          header("Location: index.php?msg=".$_SESSION['t']);
        }else{
          header('location:login.php?msg=1');
        }
	    }
		}else{
			header('location:login.php?msg=3');
		}
	} else {
		header('location:login.php?msg=1');
	}

	if(isset($conn)) {mysqli_close($conn);}
?>