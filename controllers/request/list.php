<?php
require_once('includes/includes.php');
require_once('views/request/request.php');
require_once('services/request/request.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Lista de Solicitações", "Listagem das Solicitações", "info");
	
	$cat_array = get_requests();
	display_requests($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>