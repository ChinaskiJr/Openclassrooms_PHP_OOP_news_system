<?php 
final class MySQLiNewsManager extends NewsManager {
	private $_db;
	/**
	 * Constructor of the class.
	 * @param MySQLi $db A MySQLi object.
	 */
	public function __construct(MySQLi $db) {
		$this->_db = $db;
	}
	/**
	 * Add a News object into the database.
	 * @param News $news
	 */
	public function add(News $news) {
		
	}
	/**
	 * Edit a News object into the database
	 * @param News $news
	 */
	public function edit(News $news) {
		
	}
	/**
	 * Delete a News object from the database.
	 * @param int $int The ID of the News into the database.
	 */
	public function delete($int) {
		
	}
	/**
	 * Count the amount of keys in the database
	 * @return int
	 */
	public function count() {
		
	}
}