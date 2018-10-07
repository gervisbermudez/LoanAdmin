<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin/Admin';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'admin/Admin';
$route['admin/ajax_get_dashboard_data'] = 'admin/Admin/ajax_get_dashboard_data';

// System routes
$route['admin/notificaciones'] = 'admin/Admin/notifications';
$route['admin/User/calendar'] = 'admin/User/calendar';
$route['admin/fnChangeState'] = 'admin/Admin/fnChangeState';
$route['admin/fn_ajax_check_value'] = 'admin/Admin/fn_ajax_check_value';
$route['admin/fn_ajax_delete_data'] = 'admin/Admin/fn_ajax_delete_data';

//Login Module Routes
$route['login'] = 'admin/Login';
$route['admin/login'] = 'admin/Login';
$route['admin/login/validar'] = 'admin/Login/is_valid';

//User Module Routes
$route['user'] = 'admin/User';
$route['admin/User'] = 'admin/User';
$route['admin/User/view/(:num)'] = 'admin/User/view/$1';
$route['admin/User/add'] = 'admin/User/add';
$route['admin/User/save'] = 'admin/User/save';
$route['admin/User/edit/(:num)'] = 'admin/User/edit/$1';
$route['admin/User/update'] = 'admin/User/update';
$route['upload/do_upload/avatar/(:num)'] = 'upload/do_upload_user_avatar/$1';

//Prestamos Module Routes
$route['admin/Prestamo'] = 'admin/Prestamo';
$route['admin/Prestamo/nuevo/User/(:num)'] = 'admin/Prestamo/form_new_loan_user/$1';
$route['admin/Prestamo/nuevo'] = 'admin/Prestamo/form_new_loan';
$route['admin/Prestamo/nuevo/guardar'] = 'admin/Prestamo/save_new_loan';
$route['admin/Prestamo/cuotas/(:num)'] = 'admin/Prestamo/show_dues/$1';
$route['admin/Prestamo/cuotas/pagar/(:num)'] = 'admin/Prestamo/form_new_due/$1';
$route['admin/Prestamo/coutas/pagar/guardar'] = 'admin/Prestamo/save_new_due';

//Cliente Submodule routes
$route['admin/Prestamo/clientes'] = 'admin/Prestamo/clients';
$route['admin/Prestamo/cliente/(:num)'] = 'admin/Prestamo/client/$1';
$route['admin/Prestamo/clientes/nuevo'] = 'admin/Prestamo/form_new_client';
$route['admin/Prestamo/clientes/nuevo/guardar'] = 'admin/Prestamo/save_new_client';
$route['admin/Prestamo/cliente/editar/(:num)'] = 'admin/Prestamo/form_update_client/$1';
$route['admin/Prestamo/clientes/editar/guardar'] = 'admin/Prestamo/save_update_client';

//Gastos Submodule route
$route['admin/Prestamo/gastos/registrar/(:num)'] = 'admin/Prestamo/save_new_expense/$1';
$route['admin/Prestamo/gastos/borrar/(:num)/(:num)'] = 'admin/Prestamo/delete_expense/$1/$2';

//Ingreso Submodule route
$route['admin/Prestamo/ingresos/registrar/(:num)'] = 'admin/Prestamo/save_new_incoming/$1';
$route['admin/Prestamo/ingresos/borrar/(:num)/(:num)'] = 'admin/Prestamo/delete_incoming/$1/$2';