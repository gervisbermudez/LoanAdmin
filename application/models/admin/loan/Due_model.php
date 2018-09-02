<?php 
class Due_model extends MY_model {

	public $id;
	public $id_prestamo;
	public $numero_cuota;
	public $fecha_pago;
	public $monto_total;
	public $monto_pagado = 0;
	public $estado;
	public $fecha_pagado;
	public $status = '1';
	private $table_name = 'prestamos_cuotas';

	function __construct()
	{
		parent::__construct();
	}

	public function map($id)
	{
		$due = $this->get_data(array('id' => $id), $this->table_name)[0];
		if (!$due) {
			return FALSE;
		}
		$this->id = $id;
		$this->id_prestamo = $due['id_prestamo'];
		$this->numero_cuota = $due['numero_cuota'];
		$this->fecha_pago = DateTime::createFromFormat('Y-m-d', $due['fecha_pago']);
		$this->monto_total = $due['monto_total'];
		$this->monto_pagado = $due['monto_pagado'];
		$this->estado = $due['estado'];
		$this->fecha_pagado = DateTime::createFromFormat('Y-m-d', $due['fecha_pagado']);
		$this->status = $due['status'];
		return true;
	}

	public function map_from_array($due)
	{
		$this->id = $due['id'];
		$this->id_prestamo = $due['id_prestamo'];
		$this->numero_cuota = $due['numero_cuota'];
		$this->fecha_pago = DateTime::createFromFormat('Y-m-d', $due['fecha_pago']);
		$this->monto_total = $due['monto_total'];
		$this->monto_pagado = $due['monto_pagado'];
		$this->estado = $due['estado'];
		$this->fecha_pagado = DateTime::createFromFormat('Y-m-d', $due['fecha_pagado']);
		$this->status = $due['status'];
	}

	public function create()
	{
		$insert = array('id_prestamo' => $this->id_prestamo,
						'numero_cuota' => $this->numero_cuota,
						'fecha_pago' => $this->fecha_pago->format('Y-m-d'),
						'monto_total' => $this->monto_total,
						'monto_pagado' => $this->monto_pagado,
						'estado' => $this->estado,
						'fecha_pagado' => $this->fecha_pagado->format('Y-m-d'),
						'status' => $this->status);
		if($this->set_data($insert, $this->table_name)){
			$this->id = ($this->get_data(array('id_prestamo' => $this->id_prestamo, 'numero_cuota' => $this->numero_cuota), $this->table_name)[0])['id'];
			return true;
		}
		return false;
	}

	public function update()
	{
		if (!$this->id) {
			return FALSE;
		}
		$update = array('id_prestamo' => $this->id_prestamo,
						'numero_cuota' => $this->numero_cuota,
						'fecha_pago' => $this->fecha_pago->format('Y-m-d'),
						'monto_total' => $this->monto_total,
						'monto_pagado' => $this->monto_pagado,
						'estado' => $this->estado,
						'fecha_pagado' => $this->fecha_pagado->format('Y-m-d'),
						'status' => $this->status);
		$where = array('id' => $this->id);
		return $this->update_data($where, $update, $this->table_name);
	}

	public function set_status($status = FALSE)
	{
		if (!$this->id) {
			return FALSE;
		}
		$where = array('id' => $this->id);
		if ($status === '0' || $status === '1') {
			$update = array('status' => $status);
			$this->status = $status;
		}else{
			if ($this->status === '1') {
				$update = array('status' => '0');
				$this->status = '0';
			}else{
				$update = array('status' => '1');
				$this->status = '1';
			}
		}
		return $this->update_data($where, $update, $this->table_name);
	}

	public function delete()
	{
		if (!$this->id) {
			return FALSE;
		}
		$where = array('id' => $this->id);
		$this->delete_data($where, $this->table_name);
	}

	public function get_array()
	{
		$due = array('id' => $this->id,
					 'id_prestamo' => $this->id_prestamo,
					 'numero_cuota' => $this->numero_cuota,
					 'fecha_pago' => $this->fecha_pago->format('Y-m-d'),
					 'monto_total' => $this->monto_total,
					 'monto_pagado' => $this->monto_pagado,
					 'estado' => $this->estado,
					 'fecha_pagado' => $this->fecha_pagado->format('Y-m-d'),
					 'status' => $this->status);
		return $due;
	}
}
?>