<?php	
	try {
		$conn = new PDO("mysql:host=localhost;dbname=ticket", "tuser", "tuser12qwaszxQWAS");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users WHERE time >= CURDATE() AND device = :device");
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_day = $query->fetchColumn();
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users WHERE MONTH(time) >= MONTH(CURDATE()) AND device = :device");
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_month = $query->fetchColumn();
	
	$query = $conn->prepare("SELECT COUNT(id) FROM users WHERE device = :device");
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_total = $query->fetchColumn();
	
	$result_data = [
		"day"	=>	$result_day,
		"month"	=>	$result_month,
		"total"	=>	$result_total
	];
	
	echo json_encode($result_data);
?>