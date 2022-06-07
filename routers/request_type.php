<?php
//Departamentos==========================================================================================================================================================================
$router->map( 'GET', DIRETORIO.'request_type/create', function() {
	require 'controllers/request_type/create.php';
});

$router->map( 'POST', DIRETORIO.'request_type/insert', function() {
	require 'controllers/request_type/insert.php';
});

$router->map( 'GET', DIRETORIO.'request_type/edit/[i:id]', function( $id ) {
	require 'controllers/request_type/edit.php';
});

$router->map( 'POST', DIRETORIO.'request_type/update', function() {
	require 'controllers/request_type/update.php';
});

$router->map( 'GET', DIRETORIO.'request_type/delete/[i:id]', function( $id ) {
	require 'controllers/request_type/delete.php';
});

$router->map( 'GET', DIRETORIO.'request_type/details/[i:id]', function( $id ) {
	require 'controllers/request_type/details.php';
});

$router->map( 'GET', DIRETORIO.'request_type/list', function() {
	require 'controllers/request_type/list.php';
});
?>