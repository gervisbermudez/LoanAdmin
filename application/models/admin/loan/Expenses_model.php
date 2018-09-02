<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends MY_model {

	public $id;
	public $id_user;
	public $user = array();
	public $monto;
	public $descripcion;
	public $fecha;
	public $status = '1';

	public $table = 'expenses';

	private $is_map = false;

	public function __construct()
	{
		parent::__construct();
		$this->fecha = new DateTime();
	}

	public function map($id)
	{
		$expense = $this->get_data(array('id' => $id), $this->table)[0];
		if ($expense) {
			$this->id = $id;
			$this->id_user = $expense['id_user'];
			$this->monto = $expense['monto'];
			$this->descripcion = $expense['descripcion'];
			$this->fecha = $expense['fecha'];
			$this->status = DateTime::createFromFormat('Y-m-d H:i:s', $expense['status']);
			$this->is_map = true;
			return $this;
		}else{
			return false;
		}
	}

	public function set_expense($monto, $descripcion, $id_user = false)
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

		$insert = array('monto' => (float)$monto, 'descripcion' => (string)$descripcion, 'id_user' => (int)$id_user);
		return $this->set_data($insert, $this->table);
	}

	public function get_expenses($conditions = false)
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