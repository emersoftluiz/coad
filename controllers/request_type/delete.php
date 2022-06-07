<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/request_type/request_type.php');
require_once('views/request_type/request_type.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/request_type/delete/[i:id]', 'request_type#delete', 'request_type_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_request_type($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Tipo de Requisição foi removido na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir o Tipo de Requisição. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhum Tipo de Requisição especificado. Por favor, tente novamente.';
    }
    do_html_header("Removendo um Tipo de Requisição...", $mensagem, $tipo);
	
	$cat_array = get_request_types();
	display_request_types($cat_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
