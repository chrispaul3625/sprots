<?php
namespace Edu\Cnm\dmartinez337\sprots;

require_once("autoLoader.php");

/**
 * This will be the class for a profile to chose favorite teams
 *
 * @author Dom Kratos <mr.kratos85@gmail.com>
 **/
class favoriteTeam {
	/**
	*id for the profile that has favorites; this is the foreign key
	*@var int $favoriteTeamProfileId
	**/
	private $favoriteTeamProfileId;
	/**
	*id of the team that is being favorited.
	*@var int $favoriteTeamTeamId
	**/
	private $favoriteTeamTeamId;

	/**
	*constructor for favorting a team
	*
	*@param int|nul
}
