<?php
require_once 'lib/errors.php';
require_once 'lib/autoload.php';
require_once 'templates/htmlHead.html';
try {
	require_once 'lib/dbConnect.php';
	$fiveLastNews = $manager->getList(5);
} catch (Exception $e) {
	catchException($e, true);
}
?>

<body>
	<a href="admin.php">Access to the administration page</a>
	<h1>List of the five last news</h1>
	<?php
		foreach ($fiveLastNews as $value) {
			?>
			<section class="news">
				<h2><?=htmlspecialchars($value->title())?></h2>
				<i>Écrit par <?=htmlspecialchars($value->author())?></i>
				<p><?=htmlspecialchars($value->content())?></p>
				<p class="date">
					<span>Posté le <?=$value->dateAdd()->format("Y-m-d à H\hi")?></span>
					<?php 
					// If dateEdit is different, then we print it
					if ($value->dateAdd() != $value->dateEdit()) {
						?>
						<span>Édité le <?=$value->dateEdit()->format("Y-m-d à H\hi")?></span>
						<?php 
					}
					?>
				</p>
			</section>
			<?php
		}
	?>
</body>
</html>