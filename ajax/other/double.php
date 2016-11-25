<?php
	try {
		$conn = new PDO("mysql:host=localhost;dbname=ticket", "tuser", "tuser12qwaszxQWAS");
		$conn->exec("set names utf8");
	}
	catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	$query = $conn->prepare("SELECT id, idUsr, name, time, device FROM users GROUP BY DATE(time), idUsr HAVING COUNT(*) > 1");
	$query->execute();
	$result_double = $query->fetchAll();
	
	if($query->rowCount() > 0)
	{
		echo json_encode(array(
			"count"	=>	$query->rowCount(),
			"id"	=>	$result_double[0]["id"],
			"idUsr"	=>	$result_double[0]["idUsr"],
			"name"	=>	$result_double[0]["name"],
			"time"	=>	$result_double[0]["time"],
			"device"	=>	$result_double[0]["device"]
		));
	}
	else
	{
		echo json_encode(array(
			"count"	=>	"OK",
			"id"	=>	"Fail",
			"idUsr"	=>	"Fail",
			"name"	=>	"Fail",
			"time"	=>	"Fail",
			"device" =>	"Fail"
		));
	}
?>