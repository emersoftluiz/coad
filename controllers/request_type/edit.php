<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/request_type/request_type.php');
require_once('views/request_type/request_type.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/request_type/edit/[i:id]', 'request_type#edit', 'request_type_edit');
$match = $router->match();

if (check_admin_user()){
	if ($name = get_request_type_name($match['params']['id'])) {
		$mensagem = 'Altere os dados de um Tipo de Requisição';
		do_html_header("Alterar um Tipo de Requisição", $mensagem);
        $id = $match['params']['id'];
        $cat = compact('name', 'id');
        display_request_type_form($cat);
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes do Tipo de Requisição';
		do_html_header("Alterar um Tipo de Requisição", $mensagem, "danger");
    }
	
	$cat_array = get_request_types();
	display_request_types($cat_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>
