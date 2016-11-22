<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=dbname", "user", "password");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("DELETE FROM users WHERE id = :id AND DATE(time) >= :date");
	$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
	$query->bindParam(":date", $_POST["date"], PDO::PARAM_STR, 18);
	$query->execute();
	$result = $query->fetchColumn();
	
	
	if($query->rowCount() > 0)
	{
		$status = "Запись с id ".$result[0]["id"]." успешно удалена";
	}
	else
	{
		$status = "Запись не найдена";
	}
	
	echo json_encode(array(
		"status"	=>	$status
	));
?>