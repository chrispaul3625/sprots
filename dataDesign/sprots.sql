DROP TABLE IF EXISTS playerStatistic;
DROP TABLE IF EXISTS teamStatistic;
DROP TABLE IF EXISTS statistic;
DROP TABLE IF EXISTS favoritePlayer;
DROP TABLE IF EXISTS favoriteTeam;
DROP TABLE IF EXISTS game;
DROP TABLE IF EXISTS player;
DROP TABLE IF EXISTS team;
DROP TABLE IF EXISTS sport;
DROP TABLE IF EXISTS profile;


CREATE TABLE profile (
	profileId         INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileUserName   VARCHAR(32)                 NOT NULL,
	profileEmail      VARCHAR(128)                NOT NULL,
	profileActivation CHAR(32),
	profileHash       CHAR(128)                   NOT NULL,
	profileSalt       CHAR(64)                    NOT NULL,
	UNIQUE (profileEmail),
	UNIQUE (profileUserName),
	PRIMARY KEY (profileId)
);

CREATE TABLE sport (
	sportId     INT UNSIGNED AUTO_INCREMENT NOT NULL,
	sportName   VARCHAR(32)                 NOT NULL,
	sportLeague VARCHAR(32)                 NOT NULL,
	UNIQUE (sportName),
	UNIQUE (sportLeague),
	PRIMARY KEY (sportId)
);

CREATE TABLE team (
	teamId    INT UNSIGNED AUTO_INCREMENT NOT NULL,
	teamSportId INT UNSIGNED              NOT NULL,
	teamApiId INT UNSIGNED                NOT NULL,
	teamName  VARCHAR(32)                 NOT NULL,
	teamCity  VARCHAR(50)                 NOT NULL,
	UNIQUE (teamApiId),
	UNIQUE (teamName),
	FOREIGN KEY (teamSportId) REFERENCES sport (sportId),
	PRIMARY KEY (teamId)
);

CREATE TABLE player (
	playerId    INT UNSIGNED AUTO_INCREMENT NOT NULL,
	playerApiId INT UNSIGNED                NOT NULL,
	playerSportId     INT UNSIGNED                NOT NULL,
	playerTeamId      INT UNSIGNED                NOT NULL,
	playerName  VARCHAR(64)                 NOT NULL,
	UNIQUE (playerApiId),
	UNIQUE (playerId),
	FOREIGN KEY (playerSportId) REFERENCES sport (sportId),
	FOREIGN KEY (playerTeamId) REFERENCES team (teamId),
	PRIMARY KEY (playerId)
);

CREATE TABLE game (
	gameId           INT UNSIGNED AUTO_INCREMENT NOT NULL,
	gameFirstTeamId  INT UNSIGNED                NOT NULL,
	gameSecondTeamId INT UNSIGNED                NOT NULL,
	gameTime         DATETIME                    NOT NULL,
	INDEX (gameFirstTeamId),
	INDEX (gameSecondTeamId),
	FOREIGN KEY (gameFirstTeamId) REFERENCES team (teamId),
	FOREIGN KEY (gameSecondTeamId) REFERENCES team (teamId),
	PRIMARY KEY (gameId)
);

CREATE TABLE favoriteTeam (
	favoriteTeamTeamId    INT UNSIGNED NOT NULL,
	favoriteTeamProfileId INT UNSIGNED NOT NULL,
	INDEX (favoriteTeamTeamId),
	INDEX (favoriteTeamProfileId),
	FOREIGN KEY (favoriteTeamTeamId) REFERENCES team (teamId),
	FOREIGN KEY (favoriteTeamProfileId) REFERENCES profile (profileId),
	PRIMARY KEY (favoriteTeamTeamId,favoriteTeamProfileId)
);

CREATE TABLE favoritePlayer (
	favoritePlayerPlayerId  INT UNSIGNED NOT NULL,
	favoritePlayerProfileId INT UNSIGNED NOT NULL,
	INDEX (favoritePlayerPlayerId),
	INDEX (favoritePlayerProfileId),
	FOREIGN KEY (favoritePlayerPlayerId) REFERENCES player (playerId),
	FOREIGN KEY (favoritePlayerProfileId) REFERENCES profile (profileId),
	PRIMARY KEY (favoritePlayerPlayerId, favoritePlayerProfileId)
);

CREATE TABLE statistic (
	statisticId   INT UNSIGNED AUTO_INCREMENT NOT NULL,
	statisticName VARCHAR(255)                NOT NULL,
	PRIMARY KEY (statisticId)
);

CREATE TABLE teamStatistic (
	teamStatisticTeamId      INT UNSIGNED NOT NULL,
	teamStatisticValue       VARCHAR(32)  NOT NULL,
	teamStatisticStatisticId INT UNSIGNED NOT NULL,
	teamStatisticGameId      INT UNSIGNED NOT NULL,
	INDEX (teamStatisticTeamId),
	INDEX (teamStatisticStatisticId),
	INDEX (teamStatisticGameId),
	FOREIGN KEY (teamStatisticTeamId) REFERENCES team (teamId),
	FOREIGN KEY (teamStatisticStatisticId) REFERENCES statistic (statisticId),
	FOREIGN KEY (teamStatisticGameId) REFERENCES game (gameId)
);

CREATE TABLE playerStatistic (
	playerStatisticGameId                     INT UNSIGNED NOT NULL,
	playerStatisticPlayerId    INT UNSIGNED NOT NULL,
	playerStatisticTeamId      INT UNSIGNED NOT NULL,
	playerStatisticStatisticId INT UNSIGNED NOT NULL,
	playerStatisticValue       VARCHAR(32)  NOT NULL,
	INDEX (playerStatisticPlayerId),
	INDEX (playerStatisticTeamId),
	INDEX (playerStatisticGameId),
	FOREIGN KEY (playerStatisticPlayerId) REFERENCES player (playerId),
	FOREIGN KEY (playerStatisticTeamId) REFERENCES team (teamId),
	FOREIGN KEY (playerStatisticGameId) REFERENCES game (gameId)
);

INSERT INTO sport(sportName, sportLeague) VALUES("Football", "NFL");
INSERT INTO sport(spor)
