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
	 * @see NewsManager::add()
	 */
	public function add(News $news) {
	    $q = $this->_db->prepare('INSERT INTO news(author, title, content, dateAdd, dateEdit) VALUES(?, ?, ?, NOW(), NOW())');
	    $author = $news->author();
	    $title = $news->title();
	    $content = $news->content();
	    $q->bind_param('sss', $author, $title, $content);
	    $q->execute();
  }
	/**
	 * @see NewsManager::edit()
	 */
	public function edit(News $news) {
		$q = $this->_db->prepare('UPDATE news SET content = ?, title = ?, author = ?, dateEdit = NOW() WHERE id = ?');
		$author = $news->author();
		$title = $news->title();
		$content = $news->content();
		$id = $news->id();
		$q->bind_param('sssi', $content, $title, $author, $id);
		$q->execute();
	}
	/**
	 * @see NewsManager::delete()
	 */
	public function delete($id) {
		$id = (int) $id;
		$q = $this->_db->prepare('DELETE FROM news WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();
	}
	/**
	 * @see NewsManager::count()
	 */
	public function count() {
		return $this->_db->query('SELECT id FROM news')->num_rows;
	}
	/**
	 * @see NewsManager::get()
	 */
	public function get($id) {
		$id = (int) $id;
		$q = $this->_db->prepare('SELECT id, author, title, content, dateAdd, dateEdit FROM news WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();
		$q->bind_result($id, $author, $title, $content, $dateAdd, $dateEdit);
		$q->fetch();

		return new News([
			'id' => $id,
			'author' => $author,
			'title' => $title,
			'content' => $content,
			'dateAdd' => new DateTime($dateAdd),
			'dateEdit' => new DateTime($dateEdit)
		]);
	}
	/**
	 * @see NewsManager::getList()
	 */
	public function getList($lastNews) {
		$listNews =[];
		$params = [];
		$sql = 'SELECT id, author, title, content, dateAdd, dateEdit FROM news ORDER BY id DESC';
		$sql .= ' LIMIT 0, ' . (int) $lastNews;
		$q = $this->_db->query($sql);
		// Fill results in an array
		while ($params[] = $q->fetch_assoc()) {
		}
		// Formate them
		for ($i = 0 ; $i < count($params) - 1 ; $i++) {
			$params[$i]['id'] = (int) $params[$i]['id'];
			$params[$i]['dateAdd'] = new DateTime($params[$i]['dateAdd']);
			$params[$i]['dateEdit'] = new DateTime($params[$i]['dateEdit']);
		}
		$q->free();
		$q = $this->_db->query($sql);
		$i = 0;
		// Took these arrays under objects
		while ($news = $q->fetch_object('News', array($params[$i]))) {
			$listNews[] = $news;
			$i++;
		}
		// And return an array of News objects
		return $listNews;
	}
}