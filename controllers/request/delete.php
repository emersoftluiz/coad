<?php
require_once('AltoRouter.php');
require_once('includes/includes.php');
require_once('services/request/request.php');
require_once('views/request/request.php');
require_once('views/admin/admin.php');

$router = new AltoRouter();
$router->setBasePath(BASEPATH);
$router->map('GET', '/request/delete/[i:id]', 'request#delete', 'request_delete');
$match = $router->match();

if (check_admin_user()) {
	if (isset($match['params']['id'])) {
        if(delete_request($match['params']['id'])) {
			$tipo = 'success';
		    $mensagem = 'Solicitação foi removida na base de dados.';
        } else {
			$tipo = 'danger';
		    $mensagem = 'Não foi possível excluir a Solicitação. Isso geralmente ocorre porque está em uso.';
		}
    } else {
		$tipo = 'danger';
		$mensagem = 'Nenhuma Solicitação especificada. Por favor, tente novamente.';
    }
    do_html_header("Removendo uma Solicitação...", $mensagem, $tipo);
	
	$cat_array = get_requests();
	display_requests($cat_array);
	
	do_html_footer();
} else {
    display_login_form();
}
?>
