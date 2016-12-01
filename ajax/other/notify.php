<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=ticket", "tuser", "tuser12qwaszxQWAS");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("SELECT name, device, time FROM devices WHERE time >= DATE_SUB(NOW(), INTERVAL 5 SECOND)");
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	
	echo json_encode($result);
?>