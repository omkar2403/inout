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

	function getAllRecords($conn, $pid){
		$sql = "SELECT ddate, r_no, opdno, ('OPD Presc') as status FROM ptablet WHERE opdno = '$pid' GROUP BY ddate,r_no 
			UNION ALL
			SELECT ddate, billno, pid, ('OPD Invoice') as status FROM invoice WHERE pid = '$pid' GROUP BY ddate, billno 
			UNION ALL
			SELECT ddate, billno, pid, ('IPD Invoice') as status FROM ipdinvo WHERE pid = '$pid' GROUP BY ddate,billno 
			UNION ALL
			SELECT ddate, id, pid, ('EYE Presc') as status FROM eye WHERE pid = '$pid' ORDER BY ddate DESC";
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
