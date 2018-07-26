<?php
	// Uncomment the next 2 lines to use PDO
	$db = DBFactory::MySQLConnectWithPDO();
	$manager = new PDONewsManager($db);

	// Comment the next 2 lines to unuse MySQLi
	// $db = DBFactory::MySQLConnectWithMySQLi();
	// $manager = new MySQLiNewsManager($db);
	