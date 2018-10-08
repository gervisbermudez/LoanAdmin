<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
	parent::__construct();
	$this->load->model('/admin/User_model');
  }

  public function index()
  {
    redirect('/');
  }

  public function _services(){
    $this->Loan_model->update_estados();
    $this->output->set_status_header(202);
  }
}