<?php 
final class PDONewsManager extends NewsManager {
	private $_db;
	/**
	 * Constructor of the class.
	 * @param PDO $db A PDO object.
	 */
	public function __construct(PDO $db) {
		$this->_db = $db;
	}
	/**
	 * Add a News object into the database.
	 * @param News $news
	 */
	public function add(News $news) {
		$q = $this->_db->prepare('INSERT INTO news (author, title, content, dateAdd, dateEdit) VALUES (:author, :title, :content, NOW(), NOW())');
		$q->bindValue(':author', $news->author(), PDO::PARAM_STR);
		$q->bindValue(':title', $news->title(), PDO::PARAM_STR);
		$q->bindValue(':content', $news->content(), PDO::PARAM_STR);
		$q->execute();
		$q->closeCursor();
	}
	/**
	 * Edit a News object into the database
	 * @param News $news
	 */
	public function edit(News $news) {
		$q = $this->_db->prepare('UPDATE news SET content = :content, timeEdit = NOW() WHERE id = :id');
		$q->bindValue(':id', $news->id(), PDO::PARAM_INT);
		$q->execute();
		$q->closeCursor();
	}
	/**
	 * Delete a News object from the database.
	 * @param int $int The ID of the News into the database.
	 */
	public function delete($id) {
		$q = $this->_db->prepare('DELETE FROM news WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->closeCursor();
	}
	/**
	 * Count the amount of keys in the database.
	 * @return int
	 */
	public function count() {

	}
	/**
	 * Return a News Object from the database.
	 * @param $int The ID of the News in the database.
	 * @return News
	 */
	public function get($id) {
		$q = $this->_db->prepare('SELECT id, author, title, content, dateAdd, dateEdit FROM news WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
		return $q->fetch();
	}
	/**
	 * Return an array filled with the x last news.
	 * @param $int The amout of news you want to show.
	 * @return array
	 */
	public function getList($lastNews) {
		$q = $this->_db->prepare('SELECT id, author, title, content, dateAdd, dateEdit FROM news ORDER BY id DESC LIMIT 0, :lastNews');
		$q->bindValue(':lastNews', $lastNews, PDO::PARAM_INT);
		$q->execute();
		$datas = [];
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$data['id'] = (int) $data['id'];
			$data['dateAdd'] = new DateTime($data['dateAdd']);
			$data['dateEdit'] = new DateTime($data['dateEdit']);
			array_push($datas, new News($data));
		}
		return $datas;
	}
}