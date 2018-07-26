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
	 * @param int $id The ID of the News into the database.
	 */
	abstract public function delete($id);
	/**
	 * Count the amount of keys in the database.
	 * @return int
	 */
	abstract public function count();
	/**
	 * Return a News Object from the database.
	 * @param int id The ID of the News in the database.
	 * @return News
	 */
	abstract public function get($id);
	/**
	 * Return an array filled with the x last news.
	 * @param $int The amout of news you want to show.
	 * @return array
	 */
	abstract public function getList($lastNews);
}