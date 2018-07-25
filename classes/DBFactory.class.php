<?php
class DBFactory {
	/**
	 * Load the dbms required in index.php
	 * @param string $dbms (PDO or MySQLi)
	 * @return void
	 */
	public static function load ($dbms) {
		$class = $dbms . 'NewsManager';
		if (file_exists($path = 'classes/' . $class . '.class.php')) {
			return new $class;
		} else {
			throw new RunTimeException('The class <strong> ' . $class . '</strong> doesn\'t exists.');
		}
	}
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