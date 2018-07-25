<?php
	// Uncomment the next 2 lines to use PDO
	DBFactory::load('PDO');
	DBFactory::MySQLConnectWithPDO();

	// Uncomment the next 2 lines to use MySQLi
	// DBFactory::load('MySQLi');
	// DBFactory::MySQLConnectWithMySQLi();