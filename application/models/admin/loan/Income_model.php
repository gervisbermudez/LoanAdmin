Income_model<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_model extends MY_model {

	public $id;
	public $id_user;
	public $user = array();
	public $monto;
	public $descripcion;
	public $fecha;
	public $status = '1';

	public $table = 'income';

	private $is_map = false;

	public function __construct()
	{
		parent::__construct();
		$this->fecha = new DateTime();
	}

	public function map($id)
	{
		$income = $this->get_data(array('id' => $id), $this->table)[0];
		if ($income) {
			$this->id = $id;
			$this->id_user = $income['id_user'];
			$this->monto = $income['monto'];
			$this->descripcion = $income['descripcion'];
			$this->fecha = $income['fecha'];
			$this->status = DateTime::createFromFormat('Y-m-d H:i:s', $income['status']);
			$this->is_map = true;
			return $this;
		}else{
			return false;
		}
	}

	public function set_income($monto, $descripcion, $id_user = false)
	{
		if (!$this->is_map && !$id_user) {
			return false;
		}
		if (!$id_user) {
			$id_user = $this->id_user;
			if (!is_numeric($id_user)) {
				return false;
			}
		}

		$insert = array(
			'monto' => (float)$monto, 
			'descripcion' => (string)$descripcion, 
			'id_user' => (int)$id_user
		);
		return $this->set_data($insert, $this->table);
	}

	public function get_incomes($conditions = false)
	{
		if (!$conditions) {
			if (!$this->is_map) {
				return false;
			}
			$conditions['id_user'] = $this->id_user;
		}
		return $this->get_data($conditions, $this->table);
	}

}