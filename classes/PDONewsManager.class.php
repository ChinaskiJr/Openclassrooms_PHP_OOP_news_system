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
	 * @see NewsManager::add()
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
	 * @see NewsManager::edit()
	 */
	public function edit(News $news) {
		$q = $this->_db->prepare('UPDATE news SET content = :content, title = :title, author = :author, dateEdit = NOW() WHERE id = :id');
		$q->bindValue(':author', $news->author(), PDO::PARAM_STR);
		$q->bindValue(':title', $news->title(), PDO::PARAM_STR);
		$q->bindValue(':content', $news->content(), PDO::PARAM_STR);
		$q->bindValue(':id', $news->id(), PDO::PARAM_INT);
		$q->execute();
		$q->closeCursor();
	}
	/**
	 * @see NewsManager::delete()
	 */
	public function delete($id) {
		$id = (int) $id;
		$q = $this->_db->prepare('DELETE FROM news WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$q->closeCursor();
	}
	/**
	 * @see NewsManager::count()
	 */
	public function count() {
		$q = $this->_db->query('SELECT COUNT(*) FROM news');
		return $q->fetchColumn();
	}
	/**
	 * @see NewsManager::get()
	 */
	public function get($id) {
		$id = (int) $id;
		$q = $this->_db->prepare('SELECT id, author, title, content, dateAdd, dateEdit FROM news WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$data['id'] = (int) $data['id'];
		$data['dateAdd'] = new DateTime($data['dateAdd']);
		$data['dateEdit'] = new DateTime($data['dateEdit']);
		return new News($data);
	}
	/**
	 * @see NewsManager::getList()
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