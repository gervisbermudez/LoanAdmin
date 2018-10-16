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
    $cuser = $this->session->userdata('user');

    switch ($cuser['level']) {
      case 0:
      case 1:
        $data['prestamos']    = $this->Loan_model->get_prestamos_extended();
        $data['cobradores']  = $users = $this->User_model->get_user('all'); 
      break;
      
      default:
        $data['prestamos'] = $this->Loan_model->get_prestamos_extended('AND loans.id_prestamista = ' . $this->session->userdata('user')['id']);
        $data['cobradores']  = $users = $this->User_model->get_user(array('`user_group`.`level` > ' => $cuser['level']));    
      break;
    }

    $data['head_includes'] = [
      'data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css')
    ];
    $data['footer_includes'] = [
      'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
      'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
      'datatableini' => fnAddScript(JSPATH . 'datatableini.js')
    ];

    //Load the views
    $data['page'] = $this->load->view('admin/reportes/reportes_prestamos', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

}