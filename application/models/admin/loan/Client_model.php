<?php 
class Client_model extends MY_model {

	public $id = FALSE;
	public $id_user_register;
	public $dni;
	public $nombre;
	public $apellido;
	public $direccion;
	public $telefono;
	public $registerdate;
	public $status;
	public $table = 'clients';

	public function __construct()
	{
		parent::__construct();
	}

	public function map($id)
	{
		$client = $this->get_data(array('id' => $id), $this->table)[0];
		if (!$client) {
			return FALSE;
		}
		$this->id = $id;
		$this->id_user_register = $client['id_user_register'];
		$this->dni = $client['identificacion'];
		$this->nombre = $client['nombre'];
		$this->apellido = $client['apellido'];
		$this->direccion = $client['direccion'];
		$this->telefono = $client['telefono'];
		$this->registerdate = DateTime::createFromFormat('Y-m-d H:i:s', $client['registerdate']);
		$this->status = $client['status'];
	}

	public function create()
	{
		$registerdate = new DateTime();
		$insert = array('id_user_register' => $this->id_user_register,
						'nombre' => $this->nombre,
						'apellido' => $this->apellido,
						'direccion' => $this->direccion,
						'telefono' => $this->telefono,
						'identificacion' => $this->dni,
						'registerdate' => $registerdate->format('Y-m-d H:i:s'),
						'status' => $this->status);
		if ($this->get_is_exist_value($this->table, 'identificacion', $this->dni)) {
			return FALSE;
		}
		return $this->set_data($insert, $this->table);	
	}

	public function update()
	{
		if (!$this->id) {
			return FALSE;
		}
		$update = array('id_user_register' => $this->id_user_register,
						'nombre' => $this->nombre,
						'apellido' => $this->apellido,
						'direccion' => $this->direccion,
						'telefono' => $this->telefono,
						'identificacion' => $this->dni,
						'registerdate' => $this->registerdate->format('Y-m-d H:i:s'),
						'status' => $this->status);
		$where = array('id' => $this->id);
		return $this->update_data($where, $update, $this->table);
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
		return $this->update_data($where, $update, $this->table);
	}

	public function delete()
	{
		if (!$this->id) {
			return FALSE;
		}
		$where = array('id' => $this->id);
		$this->delete_data($where, $this->table);
	}

	public function get_loan_balance($id = false){
		$id_cliente = $id;
		if(!$id){
			$id_cliente = $this->id;
		}

		$data['monto_total_prestado'] = $this->get_query("SELECT SUM(`loans`.`monto`) AS `monto_total_prestado` FROM `loans` WHERE `loans`.`status`=1 AND `loans`.`id_cliente`=$id_cliente")[0]['monto_total_prestado'];

		$data['monto_gobal_prestado'] = $this->get_query("SELECT SUM(`loans`.`monto_total`) AS `monto_gobal_prestado` FROM `loans` WHERE `loans`.`status`=1 AND `loans`.`id_cliente`=$id_cliente")[0]['monto_gobal_prestado'];

		$data['monto_total_ganado'] = $this->get_query("SELECT SUM(`loans`.`subtotal`) AS `monto_total_ganado` FROM `loans` WHERE `loans`.`status`=1 AND `loans`.`id_cliente`=$id_cliente")[0]['monto_total_ganado'];

		$data['monto_total_pagado'] = $this->get_query("SELECT SUM(`loans_dues`.`monto_pagado`) AS `monto_total_pagado` FROM `loans_dues`, loans WHERE `loans_dues`.`id_prestamo`=`loans`.`id` AND `loans`.`status`=1 AND `loans`.`id_cliente`=$id_cliente")[0]['monto_total_pagado'];

		$data['monto_deuda_total'] = $data['monto_gobal_prestado'] - $data['monto_total_pagado'];
		
		$data['porcentaje_total_pagado'] = (($data['monto_total_pagado'])*100)/$data['monto_gobal_prestado'];

		return $data;
	}
}
?>