<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin/admin';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'admin/admin';
$route['admin/ajax_get_dashboard_data'] = 'admin/admin/ajax_get_dashboard_data';

// System routes
$route['admin/notificaciones'] = 'admin/admin/notifications';
$route['admin/user/calendar'] = 'admin/user/calendar';
$route['admin/fnChangeState'] = 'admin/admin/fnChangeState';
$route['admin/fn_ajax_check_value'] = 'admin/admin/fn_ajax_check_value';
$route['admin/fn_ajax_delete_data'] = 'admin/admin/fn_ajax_delete_data';

//Login Module Routes
$route['login'] = 'admin/login';
$route['admin/login'] = 'admin/login';
$route['admin/login/validar'] = 'admin/login/is_valid';

//User Module Routes
$route['user'] = 'admin/user';
$route['admin/user'] = 'admin/user';
$route['admin/user/view/(:num)'] = 'admin/user/view/$1';
$route['admin/user/add'] = 'admin/user/add';
$route['admin/user/save'] = 'admin/user/save';
$route['admin/user/edit/(:num)'] = 'admin/user/edit/$1';
$route['admin/user/update'] = 'admin/user/update';
$route['upload/do_upload/avatar/(:num)'] = 'upload/do_upload_user_avatar/$1';

//Prestamos Module Routes
$route['admin/prestamo'] = 'admin/prestamo';
$route['admin/prestamo/nuevo/user/(:num)'] = 'admin/prestamo/form_new_loan_user/$1';
$route['admin/prestamo/nuevo'] = 'admin/prestamo/form_new_loan';
$route['admin/prestamo/nuevo/guardar'] = 'admin/prestamo/save_new_loan';
$route['admin/prestamo/cuotas/(:num)'] = 'admin/prestamo/show_dues/$1';
$route['admin/prestamo/cuotas/pagar/(:num)'] = 'admin/prestamo/form_new_due/$1';
$route['admin/prestamo/coutas/pagar/guardar'] = 'admin/prestamo/save_new_due';

//Cliente Submodule routes
$route['admin/prestamo/clientes'] = 'admin/prestamo/clients';
$route['admin/prestamo/cliente/(:num)'] = 'admin/prestamo/client/$1';
$route['admin/prestamo/clientes/nuevo'] = 'admin/prestamo/form_new_client';
$route['admin/prestamo/clientes/nuevo/guardar'] = 'admin/prestamo/save_new_client';
$route['admin/prestamo/cliente/editar/(:num)'] = 'admin/prestamo/form_update_client/$1';
$route['admin/prestamo/clientes/editar/guardar'] = 'admin/prestamo/save_update_client';

//Gastos Submodule route
$route['admin/prestamo/gastos/registrar/(:num)'] = 'admin/prestamo/save_new_expense/$1';
$route['admin/prestamo/gastos/borrar/(:num)/(:num)'] = 'admin/prestamo/delete_expense/$1/$2';

//Ingreso Submodule route
$route['admin/prestamo/ingresos/registrar/(:num)'] = 'admin/prestamo/save_new_incoming/$1';
$route['admin/prestamo/ingresos/borrar/(:num)/(:num)'] = 'admin/prestamo/delete_incoming/$1/$2';