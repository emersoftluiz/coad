<?php
require_once('includes/includes.php');
require_once('views/department/department.php');
require_once('services/department/department.php');
require_once('views/admin/admin.php');

if (check_admin_user()){
	do_html_header("Lista de Departamentos", "Listagem dos Departamentos", "info");
	
	$cat_array = get_departments();
	display_departments($cat_array);
	
	do_html_footer();
} else {
	display_login_form();
}
?>