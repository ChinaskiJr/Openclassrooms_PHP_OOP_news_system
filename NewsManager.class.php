<?php
abstract class NewsManager {
	/**
	 * Add a News object into the database.
	 * @param News $news
	 */
	abstract public function add(News $news);
	/**
	 * Edit a News object into the database
	 * @param News $news
	 */
	abstract public function edit(News $news);
	/**
	 * Delete a News object from the database.
	 * @param int $int The ID of the News into the database.
	 */
	abstract public function delete($int);
	/**
	 * Count the amount of keys in the database
	 * @return int
	 */
	abstract public function count();
}