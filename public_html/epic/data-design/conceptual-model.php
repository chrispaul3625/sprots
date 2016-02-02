<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Sprots Concepts</title>
	</head>
	<body>
		<header>
			Conceptual Model for Sprots
		</header>
		<h1>
			Entity Relationship Documentation
		</h1>
		<p>
			We'll start with seperating the professional sports, that we have chosen to make a part of our website.
		</p>
		<p>
			Professional Sport i.e. NFL, NBA, etc, will be an entity, that will have a 1 to many teams. The teams of each
			sport will also be an entity.
		</p>
		<p>
			The team entity will be 1 to many as well, and will link directly to the teams roster. Each team will have
			attributes, in the form of overall team statistics, and team rankings.
		</p>
		<p>
			The players of the team(s) will be a weak entity, considering we're only focusing on current team rosters. The
			attributes will be the individual players statistics, player's current condition, player rankings (amongst
			piers in particular sport), players bio.
		</p>
		<img src="images/sprotsConceptualModel.svg" alt="Visual Conceptual Model">
	</body>
</html>