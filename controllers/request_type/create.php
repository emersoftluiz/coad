<?php
require_once('includes/includes.php');
require_once('views/request_type/request_type.php');
require_once('services/request_type/request_type.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Novo Tipo de Requisição", "Adicione um novo Tipo de Requisição", "info");
	display_request_type_form();
	
	$cat_array = get_request_types();
	display_request_types($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>