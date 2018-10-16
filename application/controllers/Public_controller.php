<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Public_controller extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('/admin/User_model');
  }

  public function home()
  {
    $this->load-
    $home = new Admin();
    $home->index();
  }

  public function ajax_services()
  {
    $this->Loan_model->update_estados();
    $this->output->set_status_header(202);
  }
}