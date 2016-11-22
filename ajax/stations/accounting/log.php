<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=dbname", "user", "password");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("SELECT id FROM log WHERE message = :message AND device = :device AND time >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
	$query->bindValue(":message", "Connection failed", PDO::PARAM_STR);
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_connection = $query->fetchColumn();
	
	if($query->rowCount() > 0)
	{
		$response_connection = "Error";
	}
	else
	{
		$response_connection = "OK";
	}
	
	$query = $conn->prepare("SELECT id FROM log WHERE message = :message AND device = :device AND date >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
	$query->bindValue(":message", "Empty file Data.xml", PDO::PARAM_STR);
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_empty = $query->fetchColumn();
	
	if($query->rowCount() > 0)
	{
		$response_empty = "Error";
	}
	else
	{
		$response_empty = "OK";
	}
	
	$query = $conn->prepare("SELECT id FROM log WHERE message = :message AND device = :device AND date >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
	$query->bindValue(":message", "Fail reading keys.", PDO::PARAM_STR);
	$query->bindValue(":device", "accounting", PDO::PARAM_STR);
	$query->execute();
	$result_key = $query->fetchColumn();
	
	if($query->rowCount() > 0)
	{
		$response_key = "Error";
	}
	else
	{
		$response_key = "OK";
	}
	
	echo json_encode(array(
		"connection"	=>	$response_connection,
		"empty"	=>	$response_empty,
		"key"	=>	$response_key
	));
?>