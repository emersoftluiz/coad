<?php
//Departamentos==========================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'request/create', function() {
	require 'controllers/request/create.php';
});

$router->map( 'POST', DIRETORIO.'request/insert', function() {
	require 'controllers/request/insert.php';
});

$router->map( 'GET', DIRETORIO.'request/edit/[i:id]', function( $id ) {
	require 'controllers/request/edit.php';
});

$router->map( 'POST', DIRETORIO.'request/update', function() {
	require 'controllers/request/update.php';
});

$router->map( 'GET', DIRETORIO.'request/delete/[i:id]', function( $id ) {
	require 'controllers/request/delete.php';
});

$router->map( 'GET', DIRETORIO.'request/details/[i:id]', function( $id ) {
	require 'controllers/request/details.php';
});

$router->map( 'GET', DIRETORIO.'request/list', function() {
	require 'controllers/request/list.php';
});
?>