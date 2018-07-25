<?php
	// Uncomment the next 2 lines to use PDO
	$db = DBFactory::MySQLConnectWithPDO();
	$manager = new PDONewsManager($db);

	// Uncomment the next 2 lines to use MySQLi
	// $db = DBFactory::MySQLConnectWithMySQLi();
	// $manager = new MySQLiNewsManager.class.php($db);
	