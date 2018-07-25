<?php
require_once 'lib/errors.php';
require_once 'lib/autoload.php';
require_once 'templates/htmlHead.html';
try {
	require_once 'lib/dbConnect.php';
	if (!empty($_POST)) {
		// Check integrity of the data
		if (!empty($_POST['author'])) {
			if (empty($_POST['title']) || empty($_POST['content'])) {
				throw new InvalidArgumentException('The title of the post nor the content can\'t be empty.');
			}
			$news = new News($_POST);
		} else {
			throw new InvalidArgumentException('The author must have a name...');		
		}

	}
} catch (Exception $e) {
	// set the 2nd argument on true for developper mode
	catchException($e, true);
}
?>
<a href=".">Go back to the main page</a>
<form action="admin.php" method="post" style="text-align: center;">
	Author : <input type="text" name="author"/><br />
	Titre : <input type="text" name="title"/><br />
	Content :<br /><textarea name="content" cols="50" rows="10"></textarea><br />
	<input type="submit" value="Post">
</form>