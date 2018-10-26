<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Modulo Prestamo
 * Permite gestionar prestamos realizados por un usuario de la tabla user
 */
class Prestamo extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
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
    $data['title'] = "Prestamos";
    $data['h1'] = "Prestamos";
    $data['pagedescription'] = "Todos los Prestamos";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo')));

    if ($this->session->userdata('user')['level'] > 1) {
      $data['prestamos'] = $this->Loan_model->get_prestamos_extended('AND loans.id_prestamista = ' . $this->session->userdata('user')['id'], '', array('`loans`.`registerdate`', 'DESC'));
    } else {
      $data['prestamos'] = $this->Loan_model->get_prestamos_extended('', '', array('`loans`.`registerdate`', 'DESC'));

    }

    $data['head_includes'] = ['data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css')];
    $data['footer_includes'] = [
      'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
      'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
      'datatableini' => fnAddScript(JSPATH . 'datatableini.js')
    ];

    //Load the views
    $data['page'] = $this->load->view('admin/prestamo/all_loan_page', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

  /**
   * Pagina principial del submodulo clientes del modulo prestamo,
   * Permite visualizar los clientes registrados por un usuario en especifico
   * route admin/prestamo/clientes
   * @return void
   */
  public function clients()
  {

    $cuser = $this->session->userdata('user');
    
    //Pages head tags 
    $data['title'] = "Clientes";
    $data['h1'] = "Clientes";
    $data['pagedescription'] = "Todos los Clientes";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Clientes', 'admin/prestamo/clientes')));

    $data['head_includes'] = ['data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css')];
    $data['footer_includes'] = [
      'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
      'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
      'datatableini' => fnAddScript(JSPATH . 'datatableini.js')
    ];


    if ($cuser['level'] > 1) {
      $data['clientes'] = $this->Loan_model->get_cliente_extended('AND `loans_user_client`.`id_user` = ' . $cuser['id']);
    } else {
      $data['clientes'] = $this->Loan_model->get_cliente_extended();
    }
    
    //Load the views
    $data['page'] = $this->load->view('admin/prestamo/all_clientes_page', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

  /**
   * Permite visualizar la información de un cliente en especifico 
   * route admin/prestamo/cliente/(:num)
   * @param  int $id ID del cliente a visualizar en la base de datos
   * @return void
   */
  public function client($id = false)
  {
    //The data
    $data['cliente'] = $this->Loan_model->get_cliente(array('id' => $id, 'status' => 1))[0];
    if ($data['cliente']) {
      
      //Page info
      $data['title'] = "Admin | Cliente";
      $data['h1'] = "Cliente";
      $data['pagedescription'] = "Resumen detallado del cliente";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Clientes', 'admin/prestamo/clientes'), array('Resumen', 'admin/prestamo/cliente/' . $id)));
      
      //Includes
      $data['head_includes'] = [
        'data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css'),
        'morris-chart' => link_tag(JSPATH . "morris.js/morris.css"),
        'calendar-css' => link_tag(JSPATH . 'fullcalendar/dist/fullcalendar.min.css')
      ];
      $data['footer_includes'] = [
        'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
        'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
        'datatableini' => fnAddScript(JSPATH . 'datatableini.js'),
        'raphael' => fnAddScript(JSPATH . "raphael/raphael.min.js"),
        'morris' => fnAddScript(JSPATH . "morris.js/morris.min.js"),
        'moment-js' => fnAddScript(JSPATH . 'moment/min/moment.min.js'),
        'fullcalendar-js' => fnAddScript(JSPATH . 'fullcalendar/dist/fullcalendar.min.js'),
        'fullcalendarini' => fnAddScript(JSPATH . 'calendarini.js')
      ];

      $cuser = $this->session->userdata('user');
      $data['prestamos'] = false;
      switch ($cuser['level']) {
        case '0':
        case '1':
          $data['prestamos'] = $this->Loan_model->get_prestamos_extended("AND `id_cliente` = $id AND `loans`.`status` = 1");
          $data['historial_prestamo'] = $this->Loan_model->get_prestamos_extended("AND `loans`.`status` = 0");
          break;
        default:
          $data['prestamos'] = $this->Loan_model->get_prestamos_extended("AND `id_cliente` = $id AND `loans`.`status` = 1 AND `loans`.`id_prestamista`=" . $cuser['id']);
          $data['historial_prestamo'] = $this->Loan_model->get_prestamos_extended("AND `id_cliente` = $id AND `loans`.`status` = 0 AND `loans`.`id_prestamista`='" . $cuser['id'] . "'");
          break;
      }

      $data['cuotas'] = $this->MY_model->get_query('SELECT * FROM `loans_dues`, loans, `clients` WHERE `loans`.`id_cliente`=`clients`.`id` AND `loans_dues`.`id_prestamo`=`loans`.`id` AND `loans`.`id_cliente`=' . $id);

      $this->load->model('admin/loan/Client_model');
      $data['balance'] = $this->Client_model->get_loan_balance($id);

      $data['pagos_realizados'] = $this->Loan_model->get_query("SELECT DATE(`loans_dues`.`fecha_pago`) AS `Fecha`, `loans_dues`.`monto_pagado` FROM `loans`, `loans_dues` WHERE `loans`.`id`=`loans_dues`.`id_prestamo` AND `loans`.`id_cliente` = " . $id . " ORDER BY `Fecha` ASC"); 

      //Load the views
      $data['page'] = $this->load->view('admin/prestamo/cliente_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);

      $this->load->view('admin/master_template', $data);

    } else {
      $this->showError('Cliente no existe');
    }
  }

  /**
   * Permite agregar un nuevo cliente al sistema a traves de un formulario
   * route admin/prestamo/clientes/nuevo
   * @return void
   */
  public function form_new_client()
  {
    // Loads 
    $this->load->helper('form');
    $this->load->helper('array');
    $this->load->helper('functions');
    // Page Info 
    $data['title'] = "Nuevo Cliente";
    $data['h1'] = "Nuevo Cliente";
    $data['pagedescription'] = "Agregar un nuevo Cliente";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo'), array('Clientes', 'admin/prestamo/clientes'), array('Nuevo', 'admin/prestamo/clientes/nuevo')));
    $data['action'] = 'admin/prestamo/clientes/nuevo/guardar';
    $data['cliente'] = array();
    $data['page'] = $this->load->view('admin/prestamo/form_add_client_page', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);

    $this->load->view('admin/master_template', $data);
  }

  /**
   * Ejecuta el insert en la base de datos de un nuevo cliente referido por 
   * admin/prestamo/clientes/agregar
   * route admin/prestamo/save
   * @return void
   */
  public function save_new_client()
  {

    $date = new DateTime(); // The register date
    $data = array(
      'id_user_register' => $this->session->userdata('user')['id'],
      'nombre' => $this->input->post('nombre'),
      'apellido' => $this->input->post('apellido'),
      'direccion' => $this->input->post('direccion'),
      'telefono' => $this->input->post('telefono'),
      'identificacion' => $this->input->post('identificacion'),
      'registerdate' => $date->format('Y-m-d H:i:s'),
      'status' => '1',
    );

    $cliente = $this->Loan_model->get_cliente(array('identificacion' => $this->input->post('identificacion')));

    if (!$cliente) {
      //Set de client data 
      if ($this->Loan_model->set_cliente($data)) {
        $cliente = $this->Loan_model->get_cliente(array('identificacion' => $this->input->post('identificacion')));
          //Set the relation 
        $this->load->model('ModRelations');
        $relations = array('id_user' => $this->session->userdata('user')['id'], 'tablename' => 'prestamos_clientes', 'id_row' => $cliente[0]['id'], 'action' => 'crear');
        $this->ModRelations->set_relation($relations);
        $this->MY_model->set_data(array('id_user' => $this->session->userdata('user')['id'], 'id_client' => $cliente[0]['id']), 'loans_user_client');
        redirect('admin/prestamo/cliente/' . $cliente[0]['id']);
      } else {
        $this->showError();
      }
    } else {
      $this->showError('El cliente ya se encuentra registrado por otro cobrador');
    }
  }

  /**
   * Edita los datos de un cliente a traves de un formulario
   * admin/prestamo/clientes/editar
   * @return void
   */
  public function form_update_client($id)
  {
    $data['cliente'] = $this->Loan_model->get_cliente(array('id' => $id, 'status' => 1))[0];

    if ($data['cliente']) {
      // Loads 
      $this->load->helper('form');
      $this->load->helper('array');
      $this->load->helper('functions');

      // Page Info 
      $data['title'] = "Actualizar Cliente";
      $data['h1'] = "Actualizar Cliente";
      $data['pagedescription'] = "Editar datos del Cliente";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo'), array('Clientes', 'admin/prestamo/clientes'), array('Nuevo', 'admin/prestamo/clientes/nuevo')));

      $data['action'] = 'admin/prestamo/clientes/editar/guardar';
      
      //Load the views
      $data['page'] = $this->load->view('admin/prestamo/form_add_client_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);
    } else {
      $this->showError();
    }
  }

  /**
   * Ejecuta el insert en la base de datos de un nuevo cliente referido por 
   * admin/prestamo/clientes/agregar
   * route admin/prestamo/save
   * @return void
   */
  public function save_update_client()
  {
    $update = array(
      'nombre' => $this->input->post('nombre'),
      'apellido' => $this->input->post('apellido'),
      'direccion' => $this->input->post('direccion'),
      'telefono' => $this->input->post('telefono'),
      'identificacion' => $this->input->post('identificacion'),
    );
    $id_cliente = $this->input->post('id');
    $cliente = $this->Loan_model->update_cliente($update, $id_cliente);

    if ($cliente) {
      redirect('admin/prestamo/cliente/' . $id_cliente);
    } else {
      $this->showError();
    }
  }

  /**
   * Registar un nuevo prestamo
   * Despliega un formulario que permite registrar un prestamo para un cliente en especifico
   * route admin/prestamo/registrar
   * @return void
   */
  public function form_new_loan()
  {
    if ($this->session->userdata('user')['level'] < 1) {
      $data['clientes'] = $this->Loan_model->get_cliente_extended();
    } else {
      $data['clientes'] = $this->Loan_model->get_cliente_extended('AND user.id=' . $this->session->userdata('user')['id']);
    }

    if ($data['clientes']) {
        // Helpers and Librarys 
      $this->load->helper('array');
      $this->load->helper('functions');

        // Page Info 
      $data['title'] = "Registrar un nuevo Prestamo";
      $data['h1'] = "Registrar Prestamo";
      $data['pagedescription'] = "Asignar un prestamo";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo'), array('Nuevo', 'admin/prestamo/nuevo')));
        
        // Page Includes and data
      $data['head_includes'] = array(
        'date-picker-css' => link_tag(JSPATH . 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')
      );

      $data['footer_includes'] = array(
        'date-picker-js' => fnAddScript(JSPATH . 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'),
        'date-picker-js-ini' => fnAddScript(JSPATH . 'datepickerini.js')
      );

      $data['action'] = 'admin/prestamo/nuevo/guardar';
      $data['prestamo'] = array();
      $data['id_cliente'] = false;

        //Views
      $data['page'] = $this->load->view('admin/prestamo/form_add_loan_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);
    } else {
      redirect('admin/prestamo/clientes/nuevo');
    }
  }

  /**
   * Registar un nuevo prestamo
   * Despliega un formulario que permite registrar un prestamo para un cliente en especifico
   * route admin/prestamo/registrar/user/(:num)
   * @param  int $id_cliente ID del cliente a realizar prestamo
   * @return void
   */
  public function form_new_loan_user($id_cliente)
  {
    $data['cliente'] = $this->Loan_model->get_cliente(array('id' => $id_cliente))[0];
    if ($data['cliente']) {
      // Helpers and Librarys 
      $this->load->helper('array');
      $this->load->helper('functions');

      // Page Info 
      $data['title'] = "Registrar un nuevo Prestamo";
      $data['h1'] = "Registrar Prestamo";
      $data['pagedescription'] = "Asignar un prestamo";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo'), array('Nuevo', 'admin/prestamo/nuevo')));
      
      // Page Includes and data
      $data['head_includes'] = array(
        'date-picker-css' => link_tag(JSPATH . 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')
      );

      $data['footer_includes'] = array(
        'date-picker-js' => fnAddScript(JSPATH . 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'),
        'date-picker-js-ini' => fnAddScript(JSPATH . 'datepickerini.js')
      );

      $data['action'] = 'admin/prestamo/nuevo/guardar';
      $data['prestamo'] = array();
      $data['id_cliente'] = $id_cliente;

      //Views
      $data['page'] = $this->load->view('admin/prestamo/form_add_loan_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);
    } else {
      $this->showError('Cliente no encontrado');
    }
  }

  /**
   * Registra en la base de datos los datos de un prestamo 
   * referido por admin/prestamo/registrar/(:num) 
   * route admin/prestamo/nuevo/guardar
   * @return [type] [description]
   */
  public function save_new_loan()
  {
    $this->load->model('admin/prestamo/Loan_model');
    $Prestamo = new Loan_model();
    $Prestamo->id_prestamista = $this->session->userdata('user')['id'];
    $Prestamo->id_cliente = $this->input->post('id_cliente');
    $Prestamo->monto = $this->input->post('monto');
    $Prestamo->porcentaje = $this->input->post('porcentaje');
    $Prestamo->ciclo_pago = $this->input->post('ciclo_pago');
    $Prestamo->cant_cuotas = $this->input->post('cant_cuotas');
    $Prestamo->fecha_inicio = DateTime::createFromFormat('m/d/Y', $this->input->post('fecha_inicio'));
    if ($Prestamo->create()) {
      redirect('admin/prestamo/cuotas/' . $Prestamo->id);
    } else {
      $this->showError();
    }
  }

  /**
   * Muestra todos las cuotas de un prestamo pasado por parametro
   * @param  int $id_prestamo ID del prestamo referido 
   * @route admin/prestamo/cuotas/(:num)
   */
  public function show_dues($id_prestamo = false)
  {
    $data['prestamo'] = $this->Loan_model->get_prestamos_extended('AND loans.id = ' . $id_prestamo)[0];
    if ($data['prestamo']) {
      //Pages head tags 
      $data['title'] = "Admin | Prestamos | Cuotas";
      $data['h1'] = "Coutas";
      $data['pagedescription'] = "Todas los Cuotas";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array($data['prestamo']['nombre'].' '.$data['prestamo']['apellido'], 'admin/prestamo/cliente/'.$data['prestamo']['id_cliente']), array('Coutas', 'admin/prestamo')));

      $short = $this->input->get('short') ? : 'DESC';
      $orderby = $this->input->get('orderby') ? : 'registerdate';
      $limit = $this->input->get('limit') ? : '10';
      $data['action'] = 'admin/prestamo/coutas/pagar/guardar';

      $data['cuotas'] = $this->MY_model->get_data(array('id_prestamo' => $id_prestamo, 'status' => '1'), 'loans_dues');

      //Includes Pages
      $data['head_includes'] = [
        'calendar-css' => link_tag(JSPATH . 'fullcalendar/dist/fullcalendar.min.css'),
        'data-table-css' => link_tag(JSPATH . 'datatables.net-bs/css/dataTables.bootstrap.min.css'),
        'morris-css' => link_tag(JSPATH . 'morris.js/morris.css')
      ];

      $data['footer_includes'] = [
        'moment-js' => fnAddScript(JSPATH . 'moment/min/moment.min.js'),
        'fullcalendar-js' => fnAddScript(JSPATH . 'fullcalendar/dist/fullcalendar.min.js'),
        'fullcalendarini' => fnAddScript(JSPATH . 'calendarini.js'),
        'data-tabe-js' => fnAddScript(JSPATH . 'datatables.net/js/jquery.dataTables.min.js'),
        'data-tabe-js-bootstrap' => fnAddScript(JSPATH . 'datatables.net-bs/js/dataTables.bootstrap.min.js'),
        'datatableini' => fnAddScript(JSPATH . 'datatableini.js'),
        'raphael' => fnAddScript(JSPATH . 'raphael/raphael.min.js'),
        'morris' => fnAddScript(JSPATH . 'morris.js/morris.min.js')
      ];

      //Load the views
      $data['page'] = $this->load->view('admin/prestamo/all_dues_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);

    } else {
      redirect('admin/prestamo/');
    }
  }

  /**
   * Despliega un formulario que permite registra el pago de una cuota
   * route admin/prestamo/cuotas/pagar/(:num)
   * @param  boolean $id_prestamo ID couta a pagar
   * @return void
   */
  public function form_new_due($id_prestamo = false)
  {
      //$data['cuota'] = $this->MY_model->get_data(array('id' => $id_cuota, 'status' => '1'), 'prestamos_cuotas')[0];
    $this->load->model('admin/prestamo/Loan_model');
    $Prestamo = new Loan_model();
    $Prestamo->map($id_prestamo);

    if ($Prestamo->is_map) {
        // Loads 
      $this->load->helper('form');
      $this->load->helper('array');
      $this->load->helper('functions');

        // Page Info 
      $data['title'] = "Admin | Registrar Pago";
      $data['h1'] = "Registrar Pago";
      $data['pagedescription'] = "Registrar pago de cuota";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamos', 'admin/prestamo'), array('Clientes', 'admin/prestamo/clientes')));
      $data['action'] = 'admin/prestamo/coutas/pagar/guardar';

      $data['cuota'] = ($Prestamo->cuotas[0])->get_array();

      $data['prestamo'] = $this->Loan_model->get_prestamos_extended('AND loans.id = ' . $data['cuota']['id_prestamo'])[0];
      $data['page'] = $this->load->view('admin/prestamo/form_add_due_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);

      $this->load->view('admin/master_template', $data);
    } else {
      $this->showError('La cuota a pagar no existe');
    }
  }

  /**
   * Realiza el insert de la cuota pagada, referida por admin/prestamo/cuotas/pagar/(:num)
   * route admin/prestamo/coutas/pagar/guardar
   * @return [type] [description]
   */
  public function save_new_due()
  {
    $monto = (int)$this->input->post('monto');
    if ($monto > 0) {
      $id_prestamo = $this->input->post('id_prestamo');
      $this->load->model('admin/prestamo/Loan_model');
      $Loan = new Loan_model();
      $Loan->map($id_prestamo);
      if ($Loan->progreso <= 100) {
        $Loan->set_payment($monto);
        redirect('admin/prestamo/cuotas/' . $id_prestamo . '?alert=added_due');
      } else {
        redirect('admin/prestamo/cuotas/' . $id_prestamo);
      }
    } else {
      $this->showError('Monto a pagar debe ser mayor de 0');
    }
  }

  public function save_new_expense($id_user)
  {
    $this->load->model('admin/loan/Expenses_model');
    $gasto = new Expenses_model;
    $monto = (float)$this->input->post('monto');
    $descripcion = (string)$this->input->post('descripcion');
    if ($gasto->set_expense($monto, $descripcion, $this->session->userdata('user')['id'])) {
      redirect('/admin/user/view/' . $id_user);
    } else {
      $this->showError();
    }
  }

  public function delete_expense($id_user, $id)
  {
    $this->load->model('admin/loan/Expenses_model');
    $gasto = new Expenses_model;
    $where = array('id' => $id);
    if ($gasto->delete_data($where, Expenses_model::$table)) {
      redirect('/admin/user/view/' . $id_user);
    } else {
      $this->showError();
    }
  }

  public function save_new_incoming($id_user)
  {
    $this->load->model('admin/loan/Income_model');
    $ingreso = new Income_model;
    $monto = (float)$this->input->post('monto');
    $descripcion = (string)$this->input->post('descripcion');
    if ($ingreso->set_income($monto, $descripcion, $this->session->userdata('user')['id'])) {
      redirect('/admin/user/view/' . $id_user);
    } else {
      $this->showError();
    }
  }

  public function delete_incoming($id_user, $id)
  {
    $this->load->model('admin/loan/Income_model');
    $ingreso = new Income_model;
    $where = array('id' => $id);
    if ($ingreso->delete_data($where, Income_model::$table)) {
      redirect('/admin/user/view/' . $id_user);
    } else {
      $this->showError();
    }
  }

}