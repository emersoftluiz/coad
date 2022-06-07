<?php
require_once('includes/includes.php');
require_once('services/request/request.php');
require_once('views/request/request.php');
require_once('views/admin/admin.php');

if (check_admin_user()) {
	if (filled_out($_POST)){
        $title = $_POST['title'];
		$request_type_id = $_POST['request_type_id'];
		$description = $_POST['description'];
		$client_name = $_POST['client_name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$request_status_id = $_POST['request_status_id'];
		
        if(insert_request($title, $request_type_id, $description, $client_name, $email, $phone, $request_status_id)){
			$tipo = 'success';
            $mensagem = 'Solicitação "<b><i>'.htmlspecialchars($title).'</i></b>" foi adicionada na base de dados.';
        } else {
			$tipo = 'danger';
            $mensagem = 'Solicitação "<b><i>'.htmlspecialchars($title).'</i></b>" não pôde ser adicionada na base de dados.';
        }
	} else {
		$tipo = 'danger';
		$mensagem = 'Você não preencheu o formulário. Por favor, tente novamente.';
	}
	do_html_header("Adicionando uma Solicitação...", $mensagem, $tipo);
	
	display_request_form();
	
	$cat_array = get_requests();
	display_requests($cat_array);
	
    do_html_footer();
} else {
	display_login_form();
}
?>
