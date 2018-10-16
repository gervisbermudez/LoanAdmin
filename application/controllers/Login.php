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
	$this->session->sess_destroy();
	$data['title'] = "Iniciar session";
	$this->load->view('/admin/login/index_login', $data);
  }

  public function is_valid()
  {
	if ($this->input->post('username')) {
	  $password = $this->input->post('password');
	  $username = $this->input->post('username');
	  $isLoged = $this->User_model->login($username, $password);
	  // echo  $isLoged ? 'You are log in' : 'Combinacion Password / Username Invalido';
	  if ($isLoged) {
		redirect('admin');
	  }else{
		$data['title'] = "Error";
		$data['error'] = "Combinacion Password / Username Invalido";
		$this->load->view('/admin/login/index_login', $data);
	  }
	}else{
	  $this->index();
	}
  }

}