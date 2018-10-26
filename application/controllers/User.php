<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

  /*
    Permisos de acceso para este modulo:

      ACCESS
        [access_user_module]                  -> Acceder al modulo
        boolean
      
      VIEW DATA
        [view_list_user]                      -> Ver listado de usuarios
        boolean
        [view_specific_user]                  -> Ver perfil de usuario especifico 
        boolean

      CREATE DATA
        [create_any_user]                     -> Crear cualquier usuario
        boolean
        [create_specific_group_user]          -> Crear usuario por grupo especifico
        array []
      
      UPDATE DATA
        [update_any_user]                     -> Modificar usuarios
        boolean
        [update_current_user]                 -> Modificar current user
        boolean
        [update_status_user]                  -> Cambiar status de usuarios
        boolean
      
      DELETE DATA
        [delete_any_user]                     -> Eliminar usuarios
        boolean
   */

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $user = $this->session->userdata('user');
    $uri = $this->uri->uri_string();
    $arrUri = $this->uri->segment_array();
    if (preg_match('/admin\/user\/view\/(\d+)/', $uri)) {
      if ($arrUri[4] !== $user['id']) {
        $uri = 'admin/user/view/another';
      } else {
        $uri = 'admin/user/view/self';
      }
    }
    switch ($uri) {
      case 'admin/user':
        if (!$user['access_user_module']) {
          redirect('admin');
        }
      case 'admin/user/add':
        if (!$user['create_any_user']) {
          redirect('admin');
        }
        break;
      case 'admin/user/view/another':
        if (!$user['view_specific_user']) {
          redirect('admin');
        }
        break;
    }
  }

  public function index()
  {
    //Pages head tags 
    $data['title'] = "Cobradores";
    $data['h1'] = "Cobradores";
    $data['pagedescription'] = "Todos los Cobradores";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Cobradores', 'admin/user')));

    $short = $this->input->get('short') ? : 'ASC';
    $orderby = $this->input->get('orderby') ? : 'date_created';
    $limit = $this->input->get('limit') ? : '10';

    $user = $this->session->userdata('user');

    switch ($user['level']) {
      case '0':
        $users = $this->User_model->get_user('all', $limit, array("`user`.`$orderby`", $short));      # code...
        break;
      case '1':
        $users = $this->User_model->get_user(array('`user_group`.`level` >=' => $user['level']), $limit, array("`user`.`$orderby`", $short));      # code...
        break;

      default:
        $users = $this->User_model->get_user(array('`user_group`.`level` > ' => $user['level'], '`user`.`status`' => '1'), $limit, array("`user`.`$orderby`", $short));      # code...
        break;
    }

    $data['users'] = array();
    if ($users) {
      foreach ($users as $key => $value) {
        $user_model = new User_model();
        array_push($data['users'], $user_model->map($value['id']));
      }
    }
		
		//print_r($data['users']);
    //Load the views
    $data['page'] = $this->load->view('/admin/user/all_user_page', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

  public function view($id = false)
  {
    $this->load->model('ModRelations');
    $user = $this->User_model->map($id);

    if ($user->is_map) {
      $currentuser = $this->session->userdata('user');
      if ($currentuser['level'] < 3 && $currentuser['id'] === $id) {
        $relations = $this->ModRelations->get_relation('all', '25', array('date', 'DESC'));
      } else {
        $relations = $this->ModRelations->get_relation(array('id_user' => $id), '25', array('date', 'DESC'));
      }
      $data['relations'] = $this->get_datarelations($relations);
      $end = $this->input->get('date_end');
      $start = $this->input->get('date_start');
      $date = $this->input->get('date') ? $this->input->get('date') : 'today';
      $whereLoans = '';
      switch ($date) {
        case 'today':
          $data['date_label'] = 'hoy';
          $data['date_label_recaudo'] = 'Recaudo de hoy';
        break;
        case 'yesterday':
          $data['date_label'] = 'ayer';
          $data['date_label_recaudo'] = 'Recaudo de ayer';
          $whereLoans = ' AND DATE(`loans`.`registerdate`) '." BETWEEN '$start' AND '$end'";
        break;
        case 'range':
          $date = "BETWEEN '$start' AND '$end'";
          $whereLoans = ' AND DATE(`loans`.`registerdate`) '.$date;
          $data['date_label'] = 'Rango';
          $data['date_label_recaudo'] = "Recaudo entre el $start y el $end";
        break;
        default:
          $date = "BETWEEN '$start' AND '$end'";
          $whereLoans = ' AND DATE(`loans`.`registerdate`) '.$date;
          $data['date_label'] = 'Rango';
          $data['date_label_recaudo'] = "Recaudo entre el $start y el $end";
        break;
      }

      $data['title'] = $user->username;
      $data['h1'] = $user->username;
      $data['pagedescription'] = "Perfil del cobrador";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array($user->username, 'admin/user/' . $user->id)));

      $this->load->model('Loan_model');

      $data['user'] = $user;
      $data['prestamos'] = $this->Loan_model->get_prestamos_extended($whereLoans.' AND `user`.`id` =' . $id . ' ');
      $data['dues'] = $user->get_dues($date);
      $data['balance'] = array_map("format", $user->get_balance($date));
      $income_expenses = $user->get_income_expenses($date);
      $data['ingresos'] = $income_expenses['income'];
      $data['gastos'] = $income_expenses['expenses'];

      //Includes Pages
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

      // Load the views
      $data['timeline'] = $this->load->view('/admin/user/timeline', $data, true);
      $data['page'] = $this->load->view('/admin/user/profile_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);

    } else {
      $this->showError();
    }
  }

  /**
   * This method show an form to create a new user into the database 
   * @route admin/user/add
   * @return void 
   */
  public function add()
  {
    // Loads 
    $this->load->helper('array');
    $this->load->helper('functions');

    // Page Info 
    $data['title'] = "Nuevo Cobrador";
    $data['h1'] = "Nuevo Cobrador";
    $data['pagedescription'] = "Agregar un nuevo Cobrador";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array('Nuevo', 'admin/user/add')));

    $data['action'] = 'admin/user/save/';

    $user = new User_model();
    $level = $this->session->userdata('user')['level'];

    switch ($level) {
      case '0':
        $data['usergroups'] = $this->User_model->get_user_group();
        break;
      case '1':
        $data['usergroups'] = $this->User_model->get_user_group(array('`status`' => '1', '`level` >' => 1));
        break;
      default:
        $data['usergroups'] = $this->User_model->get_user_group(array('`status`' => '1', '`level` >' => $level));
        break;
    }

    $data['user'] = (array)$user;

    $data['page'] = $this->load->view('/admin/user/form_add_page', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

  /**
   * This method handle the insert user into the database 
   * @route admin/user/save
   * @return void
   */
  public function save()
  {
    $user = new User_model();

    $user->username = url_title($this->input->post('username'), 'underscore', true);
    $user->email = $this->input->post('email');
    $user->id_user_group = $this->input->post('usergroup');
    $user->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

    if ($user->create()) {
      $curuser = $this->session->userdata('user');
      $user_data = array(
        'nombre' => ucwords($this->input->post('nombre')),
        'apellido' => ucwords($this->input->post('apellido')),
        'direccion' => ucwords($this->input->post('direccion')),
        'telefono' => $this->input->post('telefono'),
        'identificacion' => $this->input->post('identificacion'),
        'create by' => ucwords($curuser['nombre'] . ' ' . $curuser['apellido']),
        'avatar' => 'avatar.png'
      );

      $date = new DateTime();

      if ($user->set_userdata($user_data)) {
        $this->load->model('User_Group_model');
        $user_groups = $this->User_Group_model::$user_groups[$this->input->post('usergroup')];
        $permisions = $this->User_Group_model::$user_roles[$user_groups['level']];
        foreach ($permisions as $key => $value) {
          $permisions[$key]['id_user'] = $user->id;
          $permisions[$key]['module'] = 'User';
          $permisions[$key]['created_from_ip'] = $this->input->ip_address();
          $permisions[$key]['updated_from_ip'] = $this->input->ip_address();
          $permisions[$key]['date_created'] = $date->format('Y-m-d H:i:s');
          $permisions[$key]['date_updated'] = $date->format('Y-m-d H:i:s');
        }
        $user->set_user_permisions($permisions);
        $this->load->model('ModRelations');
        $relations = array('id_user' => $curuser['id'], 'tablename' => 'user', 'id_row' => $user->id, 'action' => 'crear');
        $this->ModRelations->set_relation($relations);
        redirect('admin/user/view/' . $user->id);
      } else {
        $this->showError();
      }
    } else {
      $this->showError();
    }
  }

  /**
   * This method handle an edit user with a form 
   */
  public function edit($id)
  {
      //Get de user data 
    $user = $this->User_model->map($id);

    if ($user) {
      $data['user'] = (array)$user;
        //Load helpers
      $data['title'] = "Admin | Editar";
      $data['h1'] = "Editar cobrador";
      $data['action'] = 'admin/user/update/';
      $data['pagedescription'] = "Editar un cobrador";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array('Editar', 'admin/user/view/' . $user->id), array($user->username, 'admin/user/view/' . $user->id)));

      if ($this->session->userdata('user')['level'] == 0) {
        $data['usergroups'] = $this->User_model->get_user_group(array('status' => '1'));
      } else {
        $data['usergroups'] = $this->User_model->get_user_group(array('status' => '1', 'level >=' => $this->session->userdata('user')['level']));
      }
        // The views
      $data['page'] = $this->load->view('/admin/user/form_add_page', $data, true);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
      $this->load->view('admin/master_template', $data);
    } else {
      $this->showError();
    }
  }

  /**
   * This method handle the insert user into the database 
   * @route admin/user/update
   * @return void
   */
  public function update()
  {

    $user = new User_model();
    $user->map($this->input->post('id'));

    $user->username = url_title($this->input->post('username'), 'underscore', true);
    $user->email = $this->input->post('email');
    $user->id_user_group = $this->input->post('usergroup');
    $user->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

    $user->nombre = $this->input->post('nombre');
    $user->apellido = $this->input->post('apellido');
    $user->direccion = $this->input->post('direccion');
    $user->telefono = $this->input->post('telefono');
    $user->identificacion = $this->input->post('identificacion');

    if ($user->update()) {
      redirect('admin/user/view/' . $user->id . '?alert=update_profile');
    } else {
      $this->showError();
    }

  }

  public function calendar()
  {
    $data['title'] = "Admin | Calendario";
    $data['h1'] = "Calendario";
    $data['pagedescription'] = "Mi Calendario";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Calendario', 'admin/user/calendar')));
    
    //Params data
    $user = $this->session->get_userdata('user')['user'];

    if ($user['level'] < 2) {
      $data['cuotas'] = $this->MY_model->get_query('SELECT * FROM `loans_dues`, loans, `clients` WHERE `loans`.`id_cliente`=`clients`.`id` AND `loans_dues`.`id_prestamo`=`loans`.`id`');
    } else {
      $data['cuotas'] = $this->MY_model->get_query('SELECT * FROM `loans_dues`, loans, `clients` WHERE `loans`.`id_cliente`=`clients`.`id` AND `loans_dues`.`id_prestamo`=`loans`.`id` AND `loans`.`id_prestamista`= ' . $user['id']);
    }

    
    //Includes Pages
    $data['head_includes'] = [
      'calendar-css' => link_tag(JSPATH . 'fullcalendar/dist/fullcalendar.min.css')
    ];

    $data['footer_includes'] = [
      'moment-js' => fnAddScript(JSPATH . 'moment/min/moment.min.js'),
      'fullcalendar-js' => fnAddScript(JSPATH . 'fullcalendar/dist/fullcalendar.min.js'),
      'fullcalendarini' => fnAddScript(JSPATH . 'calendarini.js')
    ];

    //Load the Views
    $data['page'] = $this->load->view('admin/user/calendar_view', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }
}