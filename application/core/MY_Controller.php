<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

  public $Notifications = array();

  public function __construct()
  {
    parent::__construct();
    $user = $this->session->userdata('user');
    if (!$user['is_logged_in']) {
      redirect('admin/login');
    }
    $this->load->model('Notifications_model');
    $Notifications = new Notifications_model();
    if ($this->input->get('read')) {
      $Notifications->set_read($this->input->get('read'));
    }
    if($this->config->item('enable_profiler')){
      $this->output->enable_profiler(TRUE);
    }
  }

  public function showError($errorMsg = 'Ocurrio un error inesperado', $data = array('title' => 'Error', 'h1' => 'Error'))
  {
    $data['errorMsg'] = $errorMsg;
    $data['pagedescription'] = "500";
    $data['breadcrumb'] = '';
    //Load the view
    $data['page'] = $this->load->view('admin/error500_template', $data, true);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
    $this->load->view('admin/master_template', $data);
  }

  public function fn_ajax_delete_data()
  {
    if($this->config->item('enable_profiler')){
      $this->output->enable_profiler(FALSE);
    }
    $array_id = $this->input->post('id');
    $strTable = $this->input->post('table');
    $json = array('result' => false, 'message' => 'Error al eliminar datos');
    foreach ($array_id as $key => $id) {
      switch ($strTable) {
        case 'user':
          $curuser = $this->session->userdata('user');
          if ($curuser['delete_any_user']) {
            $this->load->model('User_model');
            if ($this->User_model->delete_user($id)) {
              $json = array('result' => true, 'message' => 'Datos eliminados con exito!');
            }
          }
          break;

        default:
          if ($this->MY_model->delete_data(array('id' => $id), $strTable)) {
            $json = array('result' => true, 'message' => 'Datos eliminados con exito!');
          }
          break;
      }
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

  public function fn_ajax_check_value()
  {
    if($this->config->item('enable_profiler')){
      $this->output->enable_profiler(FALSE);
    }
    $this->load->model('MY_model');

    $table = $this->input->post('table');
    $field = $this->input->post('field');
    $value = $this->input->post('value');

    $res = $this->MY_model->get_is_exist_value($table, $field, $value);

    $json = array('result' => false);
    if ($res) {
      $json = array('result' => true);
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

  public function fnChangeState()
  {
    if($this->config->item('enable_profiler')){
      $this->output->enable_profiler(FALSE);
    }
    $id = $this->input->post('id');
    $table = $this->input->post('table');
    $status = 0;
    if ($this->input->post('status') === '1') {
      $status = 1;
    }
    $json = array('result' => false, 'message' => 'Error al cambiar estado!');
    if ($this->MY_model->update_data(array('id' => $id), array('status' => $status), $table)) {
      $json = array('result' => true, 'message' => 'Actualizado con exito!');
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

  public function get_datarelations($relations)
  {
    $dat = false;
    if ($relations) {
      foreach ($relations as $key => $row) {
        $id = $row['id_row'];
        $table = $row['tablename'];
        $date_rel = $row['date'];
        switch ($table) {
          case 'user':
            $users = $this->MY_model->get_data($data = array('user.id' => $id), $table, $limit = '', $order = array('user.id', 'DESC'));
            $users[0]['tiperel'] = 'user';
            $users[0]['date_rel'] = $date_rel;
            $users[0]['user_rel'] = $row['username'];
            $users[0]['id_user_rel'] = $row['id_user'];

            $dat[] = $users[0];
            break;
          case 'clients':
            $prestamos_cliente = $this->MY_model->get_data($data = array('clients.id' => $id), $table, $limit = '', $order = array('id', 'DESC'));
            $prestamos_cliente[0]['tiperel'] = 'clients';
            $prestamos_cliente[0]['date_rel'] = $date_rel;
            $prestamos_cliente[0]['user_rel'] = $row['username'];
            $prestamos_cliente[0]['id_user_rel'] = $row['id_user'];

            $dat[] = $prestamos_cliente[0];
            break;

          default:

            break;
        }
      }
    }
    return $dat;
  }

  public function fn_get_BreadcrumbPage($segs)
  {
    $attributes = array(
      'class' => 'breadcrumb',
      'id' => 'mylist'
    );
    foreach ($segs as $key => $value) {
      $segs[$key] = '<a href="' . base_url($value[1]) . '">' . $value[0] . '</a>';
    }
    $segs[0] = '<a href="' . base_url('admin') . '"><i class="fa fa-dashboard"></i> Home</a>';
    return ol($segs, $attributes);
  }

  public function get_notifications($id_user = '')
  {
    $this->load->model('Notifications_model');
    $Notifications = new Notifications_model();
    $this->Loan_model->update_estados();
    if ($this->input->get('read')) {
      $Notifications->set_read($this->input->get('read'));
    }

    $Notifications->id_user = $id_user;
    $fecha = new DateTime();
    $fecha = $fecha->format('Y-m-d');

    $prestamos = $this->Loan_model->get_cuota_prestamo("AND id_prestamista = $id_user AND fecha_pago='$fecha' AND estado!='Pagado'");

    if ($prestamos) {
      foreach ($prestamos as $key => $prestamo) {
        $Notifications->code = $prestamo['id'] . '_' . $prestamo['id_prestamo'] . '_' . $prestamo['numero_cuota'] . '_due_today';
        if (!$Notifications->get_notifications(array('codigo' => $Notifications->code, 'isread' => "all"))) {
          $Notifications->description = 'Tienes una cuota por cobrar hoy';
          $fecha = DateTime::createFromFormat('Y-m-d', $prestamo['fecha_pago']);
          $Notifications->fecha = $fecha->format('Y-m-d H:i:s');
          $Notifications->type = 'Warning';
          if ($prestamo['estado'] === 'Caida') {
            $Notifications->type = 'Danger';
          }
          $Notifications->action = base_url('admin/prestamo/cuotas/' . $prestamo['id_prestamo'] . '?read=' . $Notifications->code);
          $Notifications->generate();
        }
      }
    }
    $data = $Notifications->get_notifications('unread');
    if (!$data) {
      $data = array();
    }
    return $data;
  }
}
/* End of file MY_Controller */