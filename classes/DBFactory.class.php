<?php
class DBFactory {

	/**
	 * Return a PDO object to interact with the database
	 * @return PDO
	 */
	public static function MySQLConnectWithPDO() {
		$db = new PDO('mysql:host=localhost;dbname=exercices', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	/**
	 * Return a MySQLi object to interact with the database
	 * @return MySQLi
	 */
	public static function MySQLConnectWithMySQLi() {
		return new MySQLi('localhost', 'root', '', 'news');
	}
}