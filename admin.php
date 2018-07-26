<?php
try {
	require_once 'lib/errors.php';
	require_once 'lib/autoload.php';
	require_once 'templates/htmlHead.html';
	require_once 'lib/dbConnect.php';
	if (!empty($_POST)) {
		// Check integrity of the data
		if (!empty($_POST['author'])) {
			if (empty($_POST['title']) || empty($_POST['content'])) {
				throw new InvalidArgumentException('the title of the post nor the content can\'t be empty.');
			}
			if (!isset($_POST['id'])) {
				$news = new News($_POST);
				$manager->add($news);
			} else {
				$news = $manager->get($_POST['id']);
				$news->setAuthor($_POST['author']);
				$news->setTitle($_POST['title']);
				$news->setContent($_POST['content']);
				$manager->edit($news);
			}
		} else {
			throw new InvalidArgumentException('the author must have a name...');		
		}
	}
	if (isset($_GET['edit'])) {
		$newsToEdit = $manager->get($_GET['edit']);
	}
	if (isset($_GET['delete'])) {
		$manager->delete($_GET['delete']);
	}
	$nbNews = $manager->count();
	$allNews = $manager->getList($nbNews);
} catch (Exception $e) {
	// set the 2nd argument on true for developper mode
	catchException($e, true);
}
?>

<a href=".">Go back to the main page</a>
<form action="admin.php" method="post">
	Author : <input type="text" name="author" value="<?php if(isset($newsToEdit)) echo $newsToEdit->author(); ?>"/><br />
	Titre : <input type="text" name="title" value="<?php if(isset($newsToEdit)) echo $newsToEdit->title(); ?>"/><br />
	Content :<br />
		<textarea name="content" cols="50" rows="10"><?php if(isset($newsToEdit)) echo $newsToEdit->content(); ?></textarea><br />
	<?php 
	if (isset($newsToEdit)) {
		?>
		<input type="hidden" name="id" value="<?=$newsToEdit->id()?>">
		<input type="submit" value="Edit">
		<?php
	} else {
		?>
		<input type="submit" value="Post">
		<?php
	}
	?>
</form>

<section class="editNews">
	<p>There is actually <?=$nbNews?> news. Here they are :</p>
	<table>
		<tr class="firstLineTable">
			<th>Author</th>
			<th>Title</th>
			<th>Date of creation</th>
			<th>Date of last edition</th>
			<th>Action</th>
		</tr>
		<?php
		foreach ($allNews as $key => $value) {
			?>
			<tr class="contentTable">
				<td><?=htmlspecialchars($value->author())?></td>
				<td><?=htmlspecialchars($value->title())?></td>
				<td><?=$value->dateAdd()->format("Y-m-d à H\hi")?></td>
				<?php
				if ($value->dateAdd() != $value->dateEdit()) {
					?>
					<td><?=$value->dateEdit()->format("Y-m-d à H\hi")?></td>
					<?php
				} else {
					echo '<td>-</td>';
				}
				?>
				<td><a href="?edit=<?=$value->id()?>">Edit</a> | <a href="?delete=<?=$value->id()?>">Delete</a></td>
			</tr>
			<?php
		}
		?>
	</table>
</section>
</body>
</html>