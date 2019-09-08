<?php
	
	date_default_timezone_set("Asia/Kolkata");

	function getroles($conn){
		$sql = "SELECT * FROM roles";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
	
	function getspecificrole($conn, $id){
		$sql = "SELECT * FROM roles where id=$id";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getusers($conn){
		$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getspecificuser($conn, $id){
		$sql = "SELECT * FROM users where id=$id";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getData($conn, $table){
		$sql = "SELECT * FROM $table";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getDataById($conn, $table, $id){
		$sql = "SELECT * FROM $table where id=$id";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getQueue($conn){
		$query = "SELECT count(_id) FROM reg WHERE status='queue' AND session='{$_SESSION['t']}'";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $row = mysqli_fetch_row($result);
      return $row[0];
    }
	}

	function getTablet($conn){
		$query = "SELECT tabletname FROM tablet ORDER BY tabletname";
		$result = mysqli_query($conn, $query);
		return $result;
	}

	function getDataBySpesificId($conn, $table, $var, $var2){
		$sql = "SELECT * FROM $table where $var = $var2";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function setupStats($conn){
	  $query = "SELECT value FROM `setup` where var='cname'";
	  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
	  $cc = mysqli_fetch_row($result);
	  $query = "SELECT value FROM `setup` where var='libtime'";
	  $result = mysqli_query($conn, $query) or die("Invalid query: " . mysqli_error());
	  $libtime = mysqli_fetch_row($result);

	  return $res = array($cc[0], $libtime[0]);
	}

	function getNews($conn){
		$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function checknews($conn, $loc){
		$sql = "SELECT * From news WHERE loc = '".$loc."' AND status = 'Yes' ORDER BY id DESC";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		$result = mysqli_fetch_array($result);
		return $result;
	}


?>
