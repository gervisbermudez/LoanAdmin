<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Admin';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;

$route['admin/ajax_get_dashboard_data'] = 'Admin/ajax_get_dashboard_data';
$route['admin/ajax_get_norifications'] = 'Admin/ajax_get_notifications';

// System routes
$route['admin/notificaciones'] = 'Admin/notifications';
$route['admin/user/calendar'] = 'User/calendar';
$route['admin/fnChangeState'] = 'Admin/fnChangeState';
$route['admin/fn_ajax_check_value'] = 'Admin/fn_ajax_check_value';
$route['admin/fn_ajax_delete_data'] = 'Admin/fn_ajax_delete_data';
$route['admin/fn_ajax_update_data'] = 'Admin/fn_ajax_update_data';

//Login Module Routes
$route['login'] = 'Login';
$route['admin/login'] = 'Login';
$route['admin/login/validar'] = 'Login/is_valid';

//User Module Routes
$route['user'] = 'User';
$route['admin/user'] = 'User';
$route['admin/user/view/(:num)'] = 'User/view/$1';
$route['admin/user/add'] = 'User/add';
$route['admin/user/save'] = 'User/save';
$route['admin/user/edit/(:num)'] = 'User/edit/$1';
$route['admin/user/update'] = 'User/update';
$route['upload/do_upload/avatar/(:num)'] = 'upload/do_upload_user_avatar/$1';

//Prestamos Module Routes
$route['admin/prestamo'] = 'Prestamo';
$route['admin/prestamo/nuevo/user/(:num)'] = 'Prestamo/form_new_loan_user/$1';
$route['admin/prestamo/nuevo'] = 'Prestamo/form_new_loan';
$route['admin/prestamo/nuevo/guardar'] = 'Prestamo/save_new_loan';
$route['admin/prestamo/cuotas/(:num)'] = 'Prestamo/show_dues/$1';
$route['admin/prestamo/cuotas/pagar/(:num)'] = 'Prestamo/form_new_due/$1';
$route['admin/prestamo/coutas/pagar/guardar'] = 'Prestamo/save_new_due';

//Cliente Submodule routes
$route['admin/prestamo/clientes'] = 'Prestamo/clients';
$route['admin/prestamo/cliente/(:num)'] = 'Prestamo/client/$1';
$route['admin/prestamo/clientes/nuevo'] = 'Prestamo/form_new_client';
$route['admin/prestamo/clientes/nuevo/guardar'] = 'Prestamo/save_new_client';
$route['admin/prestamo/cliente/editar/(:num)'] = 'Prestamo/form_update_client/$1';
$route['admin/prestamo/clientes/editar/guardar'] = 'Prestamo/save_update_client';

//Gastos Submodule route
$route['admin/prestamo/gastos/registrar/(:num)'] = 'Prestamo/save_new_expense/$1';
$route['admin/prestamo/gastos/borrar/(:num)/(:num)'] = 'Prestamo/delete_expense/$1/$2';

//Ingreso Submodule route
$route['admin/prestamo/ingresos/registrar/(:num)'] = 'Prestamo/save_new_incoming/$1';
$route['admin/prestamo/ingresos/borrar/(:num)/(:num)'] = 'Prestamo/delete_incoming/$1/$2';

//Reportes
$route['admin/reportes'] = 'Reportes/index';
