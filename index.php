<?php
session_start();
/*
define("HOSTNAME", "http://127.0.0.1:81/coad/");
define("DIRETORIO", "/coad/");
define("BASEPATH", "/coad");
*/
define("HOSTNAME", "/");
define("DIRETORIO", "/");
define("BASEPATH", "");

require __DIR__ . '/AltoRouter.php';

$router = new AltoRouter();

require_once('routers/users.php');
require_once('routers/admin.php');
require_once('routers/position.php');
require_once('routers/department.php');
require_once('routers/costcenter.php');
require_once('routers/request_type.php');
require_once('routers/request.php');


// match current request url=========================================================================================================================================================
$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	require __DIR__ . '/404/index.php';
}
?>