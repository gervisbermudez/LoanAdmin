<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo Prestamo
 * Permite gestionar prestamos realizados por un usuario de la tabla user
 */
class Reportes extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  /**
   * La pagina principal del modulo de Prestamo, 
   * presenta un resumen de los prestamos hechos por un user
   * route admin/prestamo
   * @return void
   */
  public function index()
  {
    //Pages head tags 
    $data['title'] = "Reportes";
    $data['h1'] = "Reportes";
    $data['pagedescription'] = "Reportes: Todos los Prestamos";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Reportes', 'admin/prestamo')));
    
    $data['date_range'] = $this->input->get('date_range');
    $where_portion = '';
    if($data['date_range']){
      $fecha_inicio = substr($data['date_range'], 0, 10); 
      $fecha_fin = substr($data['date_range'], 13);
      $fecha_inicio = DateTime::createFromFormat('m/d/Y', $fecha_inicio);
      $fecha_inicio = $fecha_inicio->format('Y-m-d');
      
      $fecha_fin = DateTime::createFromFormat('m/d/Y', $fecha_fin);
      $fecha_fin = $fecha_fin->format('Y-m-d');

      $where_portion .= " AND  DATE(`loans`.`registerdate`) >='$fecha_inicio' AND  DATE(`loans`.`registerdate`)<='$fecha_fin' ";
    }
    $fecha_seleccionada = $this->input->get('fecha_seleccionada');
    switch ($fecha_seleccionada) {
      case 'hoy':
          $where_portion = 'AND DATE(`loans`.`registerdate`) = DATE(CURRENT_DATE)';
      break;
      case 'ayer':
          $where_portion = 'AND DATE(`loans`.`registerdate`) = DATE(NOW() - INTERVAL 1 DAY)';
      break;
      
      default:
        $fecha_seleccionada;
      break;
    }

    $user_selected = $this->input->get('user_selected');
    $where_portion .= ' ';
    if($user_selected && $user_selected !== 'Todos' && is_numeric($user_selected)){
      $where_portion .= ' AND user.id = '.$user_selected;
    }

    $client_selected = $this->input->get('client_selected');
    $where_portion .= ' ';
    if($client_selected && $client_selected !== 'Todos' && is_numeric($client_selected)){
      $where_portion .= ' AND `clients`.`id` = '.$client_selected;
    }

    $cuser = $this->session->userdata('user');

    switch ($cuser['level']) {
      case 0:
      case 1:
        $data['prestamos']    = $this->Loan_model->get_query("SELECT `user`.`username`, CONCAT(`clients`.`nombre`,' ', `clients`.`apellido`) AS 'cliente', `loans`.`monto`, `loans`.`monto_pagado`, `loans`.`porcentaje`, `loans`.`registerdate`, `loans`.`subtotal`, `loans`.`monto_total` FROM `user`, `loans`, `clients`  WHERE `user`.`id` = `loans`.`id_prestamista` AND `loans`.`id_cliente` = `clients`.`id` $where_portion");
        $data['cobradores']  = $users = $this->User_model->get_user(array('user.status'=> 1, 'id_user_group >'=>'1')); 
        $data['clientes'] = $this->Loan_model->get_cliente_extended();
      break;
      default:
        $data['prestamos'] = $this->Loan_model->get_query("SELECT `user`.`username`, CONCAT(`clients`.`nombre`,' ', `clients`.`apellido`) AS 'cliente', `loans`.`monto`, `loans`.`monto_pagado`, `loans`.`porcentaje`, `loans`.`registerdate`, `loans`.`subtotal`, `loans`.`monto_total` FROM `user`, `loans`, `clients`  WHERE `user`.`id` = `loans`.`id_prestamista` AND `loans`.`id_cliente` = `clients`.`id` AND `user`.`id`".$cuser['id']." $where_portion");
        $data['cobradores']  = $users = $this->User_model->get_user(array('id' => $cuser['id']));    
        $data['clientes'] = $this->Loan_model->get_cliente_extended(' AND `loans_user_client`.`id_user` = ' . $cuser['id']);   
      break;
    }

    $data['head_includes'] = [
      'data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css'),
      'date-range-picker' => link_tag(JSPATH . 'bootstrap-daterangepicker/daterangepicker.css')
    ];

    $data['footer_includes'] = [
      'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
      'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
      'datatableini' => fnAddScript(JSPATH . 'datatableini.js'),
      'moment-js' => fnAddScript(JSPATH . 'moment/min/moment.min.js'),
      'daterangepicker' => fnAddScript(JSPATH . 'bootstrap-daterangepicker/daterangepicker.js'),
      'daterangepicker-ini' => fnAddScript(JSPATH . 'bootstrap-daterangepicker/daterangepicker-ini.js'),
    ];

    //Load the views
    $data['page'] = $this->load->view('admin/reportes/reportes_prestamos', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

}