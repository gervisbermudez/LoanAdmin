<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		echo '<pre>';
		var_dump($this->session->get_userdata('user'));
		echo '</pre>';
	}

	public function SeedDatabase(){
		echo '<pre>';
		require_once APPPATH.'database/Seeder.php';
		require_once APPPATH.'database/seeds/UserSeeder.php';
		$seeder = new UserSeeder();
		$seeder->run();
	}
}
