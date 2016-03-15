<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*set page title here*/
$PAGE_TITLE = "Home";

/*load head-utils.php - edit path as needed*/
require_once("php/templates/head-utils.php");
?>

<body class="sfooter">
	<div class="sfooter-content">
		<?php require_once("php/templates/header.php") ?>
		<main class="container">
			<div ng-view></div>
		</main>
	</div>
	<?php require_once ("php/templates/footer.php")?>
</body>
</html>