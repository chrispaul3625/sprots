<?php
/**
 * This is the micro api controller for a user to logout
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 11:09 AM
 */

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
unset($_SESSION["profile"]);