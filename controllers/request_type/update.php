<?php
require_once('includes/includes.php');
require_once('services/request_type/request_type.php');
require_once('views/request_type/request_type.php');
require_once('views/admin/admin.php');

if(check_admin_user()) {
	if (filled_out($_POST)) {
        if(update_request_type($_POST['id'], $_POST['name'])) {
			$tipo = 'success';
		    $mensagem = 'Tipo de Requisição foi alterado na base de dados.';
		} else {
			$tipo = 'danger';
		    $mensagem = 'Tipo de Requisição não pôde ser alterado na base de dados.';
		}
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Alterando Tipo de Requisição...", $mensagem, $tipo);
	
	$cat_array = get_request_types();
	display_request_types($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>
