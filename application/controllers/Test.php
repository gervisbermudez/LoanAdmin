<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
        $this->faker = Faker\Factory::create();
        echo $this->faker->firstName;
	}
}
