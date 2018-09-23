<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$user = $this->session->get_userdata('user');
		echo '<pre>';
		print_r($user['user']);
		echo '</pre>';
	}
}
