<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

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
    /* if (!$this->UserPermisions->get_access('access_user_module')) {
          redirect('admin/');
        }
    switch ($this->uri->uri_string()) {
      case 'admin/user':
        if (!$this->UserPermisions->get_access('view_list_user')) {
          redirect('admin/');
        }
        break;
      case 'admin/user/add':
        if (!$this->UserPermisions->get_access('create_any_user')) {
          redirect('admin/');
        }
        break;
      default:
        
      break;
    } */

    $this->load->model('User_model');
    
  }

  public function index()
  {
    //Pages head tags 
    $data['title'] = "Prestamistas";
    $data['h1'] = "Prestamistas";
    $data['pagedescription'] = "Todos los Prestamistas";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Prestamistas', 'admin/user')));

    $short = $this->input->get('short') ?: 'ASC';
    $orderby = $this->input->get('orderby') ?: 'date_created';
    $limit = $this->input->get('limit') ?: '10';

    $user = $this->session->userdata('user');

    if ($user['level'] <= 2) {
      $users = $this->User_model->get_user(array('user_group.level >= ' => $user['level']), $limit, array("`user`.`$orderby`", $short));
    }else{
      $users = $this->User_model->get_user(array('user_group.level > '=> $user['level']), $limit, array("`user`.`$orderby`", $short));
    }

		$data['users'] = array();
		foreach($users as $key => $value){
			$user_model = new User_model();
			array_push($data['users'], $user_model->map($value['id']));
		}
		//print_r($data['users']);
    //Load the views
    $data['page'] = $this->load->view('/admin/user/all_user_page', $data, TRUE);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, TRUE);
    $this->load->view('admin/master_template', $data);  
  }

  public function view($id = false)
  {
    $this->load->model('ModRelations');
    $user = $this->User_model->map($id);
    
    if ($user->is_map) {
      $currentuser =  $this->session->userdata('user');
      if ($currentuser['level'] < 3 && $currentuser['id'] === $id) {
          $relations = $this->ModRelations->get_relation('all', '25', array('date','DESC'));
      }else{
        $relations = $this->ModRelations->get_relation(array('id_user'=>$id), '25', array('date','DESC')); 
      }
      $data['relations'] = $this->get_datarelations($relations);

      $this->load->model('admin/loan/Expenses_model');
      $gastos = new Expenses_model();
      $data['gastos'] = $gastos->get_data(array('id_user' => $id), $gastos->table);
      /* echo '<pre>';
      var_dump($data['gastos']);
      echo '</pre>'; */ /**/
      
      $data['title'] = $user->username;
      $data['h1'] = $user->username;
      $data['pagedescription'] = "Perfil del usuario";
      $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array($user->username, 'admin/user/'.$user->id)));

      $this->load->model('Loan_model');

      $data['user'] = $user;
      $data['prestamos'] = $this->Loan_model->get_prestamos_extended('AND user.id ='.$id);

      // Load the views
      $data['timeline'] = $this->load->view('/admin/user/timeline', $data, TRUE);
      $data['page'] = $this->load->view('/admin/user/profile_page', $data, TRUE);
      $data['pagecontent'] = $this->load->view('admin/content_template', $data, TRUE);
      $this->load->view('admin/master_template', $data); /**/

    }else{
      $this->showError();
    }
  }

  public function add()
  {
    // Loads 
    $this->load->helper('array');
    $this->load->helper('functions');

    // Page Info 
    $data['title'] = "Nuevo prestamista";
    $data['h1'] = "Nuevo prestamista";
    $data['pagedescription'] = "Agregar un nuevo prestamista";
    $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array('Nuevo', 'admin/user/add')));

    $data['action'] = 'admin/user/save/';
 
    $user = new User_model();
    $level = $this->session->userdata('user')['level'];

    if ($level <= 2) {
      $data['usergroups'] = $this->User_model->get_user_group(array('status'=>'1', 'level >' => 1));
    }else{
      $data['usergroups'] = $this->User_model->get_user_group(array('status'=>'1', 'level >' => $level));
    }

    $data['user'] = (array)$user;
    
    $data['page'] = $this->load->view('/admin/user/form_add_page', $data, TRUE);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, TRUE);
    $this->load->view('admin/master_template', $data);
  }

  public function save()
  {
    $user = new User_model();
    
    $user->username = url_title($this->input->post('username'), 'underscore', TRUE);
    $user->email = $this->input->post('email');
    $user->id_user_group = $this->input->post('usergroup');

    if($user->create(password_hash($this->input->post('password'), PASSWORD_DEFAULT))){
      $curuser = $this->session->userdata('user');
      $user_data = array(
        'nombre' => $this->input->post('nombre'),
        'apellido' => $this->input->post('apellido'),
        'direccion' => $this->input->post('direccion'), 
        'telefono' => $this->input->post('telefono'),
        'identificacion' => $this->input->post('identificacion'),
        'create by' => $curuser['nombre'].' '.$curuser['apellido'],
        'avatar' => 'avatar.png'
      );
      if($user->set_userdata($user_data)){
          if ($this->input->post('usergroup') === '1') {
          $datauserpermisions = array(
            array('permision' => 'access_user_module', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'view_list_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'view_specific_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'create_any_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_any_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_current_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_status_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'delete_any_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id)
          );
        }else{
          $datauserpermisions = array(
            array('permision' => 'access_user_module', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'view_list_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'view_specific_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'create_any_user', 'value' => '0', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_any_user', 'value' => '0', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_current_user', 'value' => '1', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'update_status_user', 'value' => '0', 'module' => 'User', 'status' => '1', 'id_user' => $user->id),
            array('permision' => 'delete_any_user', 'value' => '0', 'module' => 'User', 'status' => '1', 'id_user' => $user->id)
          );
        }
        $user->set_user_permisions($datauserpermisions);
        $this->load->model('ModRelations');
        $relations = array('id_user' => $curuser['id'], 'tablename' => 'user', 'id_row' => $user->id, 'action' => 'crear');
        $this->ModRelations->set_relation($relations);
        redirect('admin/user/view/'.$user->id);
      }else {
        $this->showError();        
      }
    }else {
      $this->showError();
    }
  }

  public function edit($id)
  {
      //Get de user data 
      $user = $this->User_model->map($id);
      
      if ($user) {
        $data['user'] = $user;
        //Load helpers
        $this->load->helper('array');
        $this->load->helper('functions');

        $data['title'] = "Admin | Editar";
        $data['h1'] = "Editar Usuario";
        $data['action'] = 'admin/user/update/';
        $data['pagedescription'] = "Editar un usuario";
        $data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Usuarios', 'admin/user'), array('Editar', 'admin/user/view/'.$user->id), array($user->username, 'admin/user/view/'.$user->id)));
        if ($this->session->userdata('user')['level'] <= 2) {
          $data['usergroups'] = $this->User_model->get_user_group(array('status'=>'1', 'level >'=>1));
        }else{
          $data['usergroups'] = $this->User_model->get_user_group(array('status'=>'1', 'level >'=>$this->session->userdata('user')['level']));
        }

        // The views
        $data['page'] = $this->load->view('/admin/user/form_add_page', $data, TRUE);
        $data['pagecontent'] = $this->load->view('admin/content_template', $data, TRUE);
        $this->load->view('admin/master_template', $data);
      }else{
        $this->showError();
      } 
  }

}