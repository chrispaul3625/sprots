<?php
/**
 * This is an api to collect Teams from Fantasy data
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 11:23 AM
 */

$query_params = array(
	'Ocp-Apim-Subscription-key' => 'subkey',
);

$getdata = http_build_query($query_params);

$opts = array(
	'http' => array(
		'method' => "GET",
		'header' => "Content-Type: application/x-www-form-urlencoded", 'content' => $getdata)
);
$context = stream_context_create($opts);

$response = file_get_contents('https://api.fantasydata.net/nfl/v2/JSON/Teams/season');

