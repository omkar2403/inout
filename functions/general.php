<?php
	function getsl($conn, $id, $table){
		$query = "SELECT max($id) FROM $table";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		$id = $row[0];
		if(!$id){
			$id = 1;
			return $id;
		}else{
			$id = $id + 1;
			return $id;
		}
	}


?>