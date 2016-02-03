<?php
namespace Edu\Cnm\cpaul9\sprots;

require_once("autoloader.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
	class PlayerStatistics {
		/**
		 * $playerStatisticGameId id for player in a specific game; this is a foreign key
		 * @var int $playerStatisticGameId
		 **/
		private $playerStatisticGameId;
		/**
		 * $playerStatisticPlayerId id for players overall statistics, this is a foreign key
		 * @var int $playerStatisticPlayerId
		 **/
		private $playerStatisticPlayerId;
		/**
		 * $playerStatisticStatisticId id for the players individual statistic, this is a foreign key
		 * @var int $playerStatisticStatisticId
		 **/
		private $playerStatisticStatisticId;
		/**
		 * $playerStatisticValue the value of individual stats, number value for a stat
		 * @var int $playerStatisticValue
		 **/
		private $playerStatisticValue;









	}