CREATE TABLE profile (
	profileId       INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileUserName VARCHAR(32)                 NOT NULL,
	profileEmail    VARCHAR(128)                NOT NULL,
	UNIQUE (profileEmail),
	UNIQUE (profileUserName),
	PRIMARY KEY (profileId)
);

CREATE TABLE sport (
	sportId     INT UNSIGNED AUTO_INCREMENT NOT NULL,
	sportTeam   VARCHAR(3)                  NOT NULL,
	sportLeague VARCHAR(32)                 NOT NULL,
	UNIQUE (sportTeam),
	UNIQUE (sportLeague),
	PRIMARY KEY (sportId)
);

CREATE TABLE team (
	teamId    INT UNSIGNED AUTO_INCREMENT NOT NULL,
	sportId   INT UNSIGNED                NOT NULL,
	teamApiId INT UNSIGNED                NOT NULL,
	teamName  VARCHAR(32)                 NOT NULL,
	teamCity  VARCHAR(32)                 NOT NULL,
	UNIQUE (teamApiId),
	UNIQUE (teamName),
	FOREIGN KEY (sportId) REFERENCES sport (sportId),
	PRIMARY KEY (teamId)
);

CREATE TABLE player (
	playerId    INT UNSIGNED AUTO_INCREMENT NOT NULL,
	playerApiId INT UNSIGNED                NOT NULL,
	sportId     INT UNSIGNED                NOT NULL,
	teamId      INT UNSIGNED                NOT NULL,
	playerName  VARCHAR(64)                 NOT NULL,
	UNIQUE (playerApiId),
	UNIQUE (playerId),
	FOREIGN KEY (sportId) REFERENCES sport (sportId),
	FOREIGN KEY (teamId) REFERENCES team (teamId),
	PRIMARY KEY (playerId)
);

CREATE TABLE game (
	teamId           INT UNSIGNED                NOT NULL,
	gameId           INT UNSIGNED AUTO_INCREMENT NOT NULL,
	gameFirstTeamId  INT UNSIGNED                NOT NULL,
	gameSecondTeamId INT UNSIGNED                NOT NULL,
	gameTime         DATETIME                    NOT NULL,
	INDEX (teamId),
	UNIQUE (gameId),
	FOREIGN KEY (teamId) REFERENCES team (teamId)
);

CREATE TABLE favoriteTeam (
	teamId                INT UNSIGNED NOT NULL,
	profileId             INT UNSIGNED NOT NULL,
	favoriteTeamTeamId    INT UNSIGNED NOT NULL,
	favoriteTeamProfileId INT UNSIGNED NOT NULL,
	INDEX (teamId),
	INDEX (profileId),
	FOREIGN KEY (teamId) REFERENCES team (teamId),
	FOREIGN KEY (profileId) REFERENCES profile (profileId)
);

CREATE TABLE favoritePlayer (
	playerId                INT UNSIGNED NOT NULL,
	profileId               INT UNSIGNED NOT NULL,
	favoritePlayerPlayerId  INT UNSIGNED NOT NULL,
	favoritePlayerProfileId INT UNSIGNED NOT NULL,
	INDEX (playerId),
	INDEX (profileId),
	FOREIGN KEY (playerId) REFERENCES player (playerId),
	FOREIGN KEY (profileId) REFERENCES profile (profileId)
);

CREATE TABLE statistic (
	statisticId   INT UNSIGNED AUTO_INCREMENT NOT NULL,
	statisticName VARCHAR(255)                NOT NULL
);

CREATE TABLE teamStatistic (
	teamId                   INT UNSIGNED NOT NULL,
	statisticId              INT UNSIGNED NOT NULL,
	gameId                   INT UNSIGNED NOT NULL,
	teamStatisticTeamId      INT UNSIGNED NOT NULL,
	teamStatisticValue       VARCHAR(8)   NOT NULL,
	teamStatisticStatisticId INT UNSIGNED NOT NULL,
	teamStatisticGameId      INT UNSIGNED NOT NULL,
	INDEX (teamId),
	INDEX (statisticId),
	INDEX (gameId),
	FOREIGN KEY (teamId) REFERENCES team (teamId),
	FOREIGN KEY (statisticId) REFERENCES statistic (statisticId),
	FOREIGN KEY (gameId) REFERENCES game (gameId)
);