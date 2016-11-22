<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=dbname", "user", "password");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users WHERE time >= CURDATE()");
	$query->execute();
	$result_day = $query->fetchColumn();
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users WHERE MONTH(time) >= MONTH(CURDATE())");
	$query->execute();
	$result_month = $query->fetchColumn();
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users");
	$query->execute();
	$result_total = $query->fetchColumn();
	
	echo json_encode(array(
		"day"	=>	$result_day,
		"month"	=>	$result_month,
		"total"	=>	$result_total
	));
?>