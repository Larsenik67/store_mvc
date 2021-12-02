<?php //FRONT CONTROLLER
session_start();

require "config.php";//CONSTANTES DE l'APPLICATION
require "service/Router.php";

$response = Router::handleRequest();
$page = $response !== false ? $response["view"] : Router::NOT_FOUND;

ob_start();
include($page);
$content = ob_get_contents();
ob_end_clean();

require(VIEW_PATH."layout.php");
