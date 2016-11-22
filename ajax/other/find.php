<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=dbname", "user", "password");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	/*$query = $conn->prepare("SELECT name FROM users");
	//$query->bindParam(":name", $name, PDO::PARAM_STR, 12);
	$result = $query->fetchColumn();*/
	$query = $conn->prepare("SELECT id, idUsr, name, time, device, hash FROM users WHERE idUsr = :id AND DATE(time) = :date");
	$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
	$query->bindParam(":date", $_POST["date"], PDO::PARAM_STR, 18);
	$query->execute();
	$result = $query->fetchAll();
	
	
	if($query->rowCount() > 0)
	{
		echo json_encode(array(
			"id"	=>	$result[0]["id"],
			"idUsr"	=>	$result[0]["idUsr"],
			"name"	=>	$result[0]["name"],
			"time"	=>	$result[0]["time"],
			"device"	=>	$result[0]["device"],
			"hash"	=>	$result[0]["hash"],
		));
	}
	else
	{
		echo json_encode(array(
			"id"	=>	"Fail",
			"idUsr"	=>	"Fail",
			"name"	=>	"Fail",
			"time"	=>	"Fail",
			"device"	=>	"Fail",
			"hash"	=>	"Fail",
		));
	}
?>