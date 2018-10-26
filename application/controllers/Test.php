<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$prestamo = new Loan_model();
		$prestamo->map(79);
		echo '<pre>';
		print_r($prestamo->get_index_due_to_pay());
		echo '</pre>';
		echo '<pre>';
		print_r($prestamo->set_payment(4000));
		echo '</pre>';
		echo '<pre>';
		print_r($prestamo);
		echo '</pre>';
	}

	public function SeedDatabase(){
		echo '<pre>';
		require_once APPPATH.'database/Seeder.php';
		require_once APPPATH.'database/seeds/UserSeeder.php';
		$seeder = new UserSeeder();
		$seeder->run();
	}

	public function phpinfo()
	{
		phpinfo();
	}

	public function profiler(){
		$this->output->enable_profiler(TRUE);
	}
}
