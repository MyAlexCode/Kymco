<?php

 include('log.php');
	function import($query){
		$mysqli = new mysqli(SERVER,USER,PASS,DB);
		if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
} 
		//$result = $mysqli->query($query);
		$sql=$query;
		if ($mysqli->query($sql) === TRUE) {
			$last_id = $mysqli->insert_id;
			return "record inserted";
			} else {
  return "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
		}

function select($query){
		$mysqli = new mysqli(SERVER,USER,PASS,DB); 
		if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
} 		
		$result = $mysqli->query($query);
				return $result;
				$mysqli->close();
		}

?>