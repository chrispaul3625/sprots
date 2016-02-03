<?php
namespace Edu\Cnm\cpaul9\sprots;

require_once("autoloader.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
	class PlayerStatistics {
	/**
	 * id for this team; this is the primary key
	 * @var int $teamId
	 **/
	private $teamId;
	/**
	 * teamCity, one city per team.
	 * @var string $teamCity
	 **/
	private $teamCity;
	/**
	 * teamName, one team name per team.
	 * @var string $teamName
	 **/
	private $teamName;
	/**
	 * teamApiId, one Api id per team.
	 * @var int $teamApiId
	 **/
	private $teamApiId;