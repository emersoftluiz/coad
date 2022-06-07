<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/request/request.php');
require_once('views/request/request.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/request/edit/[i:id]', 'request#edit', 'request_edit');
$match = $router->match();

if (check_admin_user()){
	if ($request = get_request_details($match['params']['id'])) {
		$mensagem = 'Altere os dados da Solicitação';
		do_html_header("Alterar Solicitação", $mensagem);
        display_request_form($request);
	
    } else {
		$tipo = 'danger';
		$mensagem = 'Não foi possível recuperar os detalhes da Solicitação';
		do_html_header("Alterar Solicitação", $mensagem, "danger");
    }
	
	$request_array = get_requests();
	display_requests($request_array);
		
    do_html_footer();
} else {
    display_login_form();
}

?>