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