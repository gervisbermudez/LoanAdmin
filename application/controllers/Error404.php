<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  
  public function index()
  {
    $user = $this->session->userdata('user');
    $data['user'] = $user;
    $data['title'] = "404";
    $data['h1'] = "404 Not Found";
    $data['pagedescription'] = "";
    $data['breadcrumb'] = "";
    $data['page'] = $this->load->view('admin/error404_template', $data, TRUE);
    $data['pagecontent'] = $this->load->view('admin/content_template', $data, TRUE);
    $this->load->view('admin/master_template', $data);
  }
}
