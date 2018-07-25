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
}