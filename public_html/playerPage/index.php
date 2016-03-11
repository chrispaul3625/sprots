<!DOCTYPE html>
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Sports";
/*load head-utils.php - edit path as needed*/
require_once(dirname(__DIR__)."/php/templates/head-utils.php");
?>
	<body class="sfooter">
		<?php require_once (dirname(__DIR__)."/php/templates/header.php") ?>

		<div class="sfooter-content">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="content-box">
							<h2> Favorited Teams </h2>
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
						</div>
					</div>

					<div class="col-md-10">
						<div class="content-box">
							<div class="content-box" ng-controller="playerController">
								<h2> Player Stats</h2>
								<div ng-repeat="player in players">
									<p> {{ player.playerId }}
										{{player.playerName}}
										{{player.playerCity}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer class="container">
			<div class="col-md-12">
				<div class="row">
					<div class="content-box">
					</div>
				</div>
			</div>

			<h2> Footer </h2>
			There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc
		</footer>
	</body>
