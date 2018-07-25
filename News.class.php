<?php
class News {
	private $_id;
	private $_author;
	private $_title;
	private $_content;
	private $_dateAdd;
	private $_dateEdit;

	// Getters
	public function id() {
		return $this->_id;
	}
	public function author() {
		return $this->_author;
	}
	public function title() {
		return $this->_title;
	}
	public function content() {
		return $this->_content;
	}
	public function dateAdd() {
		return $this->_dateAdd;
	}
	public function dateEdit() {
		return $this->_dateEdit;
	}
	// Setters
	/**
	 * Check if $id is an integer and set it, throw an Exception if it isn't.
	 * @param int $id The ID to set.
	 * @return void
	 */
	public function setId($id) {
		if (!is_int($id)) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News id must be an integer. Input was <strong>' . $id .'</strong>.');
		} else {
			$this->_id = $id;
		}
	}
	/**
	 * Check if $author is a string lower than 20 characters and set it, throw an exception if it isn't.
	 * @param string $author The name of the author to set. 
	 * @return void
	 */
	
	public function setAuthor($author) {
		if (!is_string($author)) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News author must be a string. Input was <strong>' . $author . '</strong>.');
		}
		if (strlen($author) > 20 ) {
			throw new LengthException('<strong>Length Error</strong> : The News author string must be lower than 20 characters. Input "' . $author . '" had <strong>' . strlen($author) . '</strong> characters.');
		}
		$this->_author = $author;
	}
	/**
	 * Check if $title is a string lower than 20 characters and set it, throw an exception if it isn't.
	 * @param string $title The title to set.
	 * @return void
	 */
	public function setTitle($title) {
		if (!is_string($title)) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News title must be a string. Input was <strong>' . $title . '</strong>.');
		}
		if (strlen($title) > 20 ) {
			throw new LengthException('<strong>Length Error</strong> : The News title string must be lower than 20 characters. Input "' . $title . '" had <strong>' . strlen($title) . '</strong> characters.');
		}
		$this->_title = $title;
	}
	/**
	 * Check if $content is a string and set it, throw an exception if it isn't.
	 * @param string $content The content to set.
	 * @return void
	 */
	public function setContent($content) {
		if (!is_string($content)) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News content must be a string. Input was <strong>' . $content . '</strong>.');
		}
		$this->_content = $content;
	}
	/**
	 * Check if $dateAdd is an instance of DateTime and set it, throw an exception if it isn't.
	 * The $dateAdd argument isn't required as a DateTime object in function's signature because we want the error to be set by an Exception and not as a PHP Fatal Error (not pretty).
	 * @param DateTime $dateAdd The date to set.
	 * @return void
	 */
	public function setDateAdd($dateAdd) {
		if (!$dateAdd instanceof DateTime) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News dateAdd must be an instance of DateTime.');
		}
		$this->_dateAdd = $dateAdd;
	}
	/**
	 * Check if $dateEdit is an instance of DateTime and set it, throw an exception if it isn't.
	 * The $dateEdit argument isn't required as a DateTime object in function's signature because we want the error to be set by an Exception and not as a PHP Fatal Error (not pretty).
	 * @param DateTime $dateAdd The date to set.
	 * @return void
	 */
	public function setDateAdd($dateEdit) {
		if (!$dateEdit instanceof DateTime) {
			throw new InvalidArgumentException('<strong>Invalid Argument</strong> : The News dateEdit must be an instance of DateTime.');
		}
		$this->_dateEdit = $dateEdit;
	}

}