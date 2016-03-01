<?php
/**
 * This is an api to collect Teams from Fantasy data
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 11:23 AM
 */
require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

//verify the xsrf challange
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	// grab the db connection
	$pdo = connetToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

	// determine which http method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// handle REST calls
	if($method === "GET" || $method === "PUT") {

		// set XSRF cookie
		setXsrfCookie("/");

		// sanitize inputs
		$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
		$teamId = filter_input(INPUT_GET, "teamId", FILTER_VALIDATE_INT);
		$teamCity = filter_input(INPUT_GET, "teamCity", FILTER_SANITIZE_STRING);
		$teamName = filter_input(INPUT_GET, "teamName", FILTER_SANITIZE_STRING);
		$teamSportId = filter_input(INPUT_GET, "teamSportId", FILTER_VALIDATE_INT);

		// get the team based on the given field
		if(empty($id) === false) {
			$team = Team::getTeamByTeamId($pdo, $id)
		}


		try {
			$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
			if(empty($season) === true) {
				$today = new DateTime();
				$season = $today->format("Y");
			}

			$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

			$opts = array(
				'http' => array(
					'method' => "GET",
					'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"], 'content' => "{body}")
			);
			$context = stream_context_create($opts);

			$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Teams/$season", false, $context);
			$reply->data = json_decode($response);
		} catch() {
			// todo
		}
		foreach($reply->data as $team) {
			$teamToInsert = new Team(null, $team->Name, $team->City, $team->KEY, 1);
			$teamToInsert->insert($pdo);
		}
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);