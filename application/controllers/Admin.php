<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Admin";
		$data['h1'] = "Inicio";
		$data['pagedescription'] = "";
		$data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin')));
		//$data['head_includes'] = ['morris-chart' => '<link rel="stylesheet" href="public/chart.js/Chart.js">'];
		$data['footer_includes'] = ['chart' => '<script src="' . JSPATH . 'chart.js/Chart.js"></script>']; 
		//Load the Views
		$cuser = $this->session->userdata('user');
		$this->load->model('admin/loan/Client_model');
		$data['users'] = array();
		switch ($cuser['level']) {
			case 0:
			case 1:
				$data['prestamos'] = $this->Loan_model->get_prestamo(array('status' => 1), '5', array('registerdate', 'DESC'));
				$data['cuotas'] = $this->Loan_model->get_simple_next_dues();
				$data['clientes'] = $this->Loan_model->get_query('SELECT * FROM `clients` ORDER BY `clients`.`registerdate` ASC LIMIT 5');
				$users = $this->User_model->get_user(array('user.status' => '1', 'level >'=> '0'), '5');
				if ($users) {
					foreach ($users as $key => $value) {
						$user_model = new User_model();
						array_push($data['users'], $user_model->map($value['id']));
					}
				}
				break;
			case 2:
				$data['prestamos'] = $this->Loan_model->get_prestamo(array('id_prestamista' => $cuser['id'], 'status' => 1), '5',  array('registerdate', 'DESC'));
				$data['cuotas'] = $this->Loan_model->get_simple_next_dues("AND `loans`.`id_prestamista` =" . $cuser['id']);
				$data['clientes'] = $this->Loan_model->get_query('SELECT * FROM `clients` WHERE `id_user_register`= ' . $cuser['id'] . ' ORDER BY `clients`.`registerdate` ASC LIMIT 5');
				$users = $this->User_model->get_user(array('`user_group`.`level` >=' => $cuser['level'], 'user.status' => '1'), '5');
				if ($users) {
					foreach ($users as $key => $value) {
						$user_model = new User_model();
						array_push($data['users'], $user_model->map($value['id']));
					}
				}
				break;
			default:
				$data['prestamos'] = $this->Loan_model->get_prestamo(array('id_prestamista' => $cuser['id'], 'status' => 1), '10', array('registerdate', 'DESC'));
				$data['cuotas'] = $this->Loan_model->get_simple_next_dues("AND `loans`.`id_prestamista` =" . $cuser['id']);
				$data['clientes'] = $this->Loan_model->get_query('SELECT * FROM `clients` WHERE `id_user_register`= ' . $cuser['id'] . ' ORDER BY `clients`.`registerdate` ASC LIMIT 5');
				$users = $this->User_model->get_user(array('`user_group`.`level` >=' => $cuser['level'], 'user.status' => '1'), '5');
				if ($users) {
					foreach ($users as $key => $value) {
						$user_model = new User_model();
						array_push($data['users'], $user_model->map($value['id']));
					}
				}
				break;
		}

		//Load the views
		$data['pagecontent'] = $this->load->view('admin/dashboard', $data, true);
		$this->load->view('admin/master_template', $data);
	}

	public function notifications()
	{
		$data['title'] = "Admin | Notificaciones";
		$data['h1'] = "Notificaciones";
		$data['pagedescription'] = "Todas las Notificaciones";
		$data['breadcrumb'] = $this->fn_get_BreadcrumbPage(array(array('Admin', 'admin'), array('Notificaciones', 'admin/notificationes')));
		//Load the Views
		$Notifications = new Notifications_model();
		$Notifications->id_user = $this->session->userdata('user')['id'];
		$data['notificacions'] = $Notifications->get_notifications(array('isread' => 'all'));
		$data['page'] = $this->load->view('admin/all_notifications', $data, true);
		$data['pagecontent'] = $this->load->view('admin/content_template', $data, true);
		$this->load->view('admin/master_template', $data);
	}

	public function ajax_get_dashboard_data()
	{
		if ($this->config->item('enable_profiler')) {
			$this->output->enable_profiler(false);
		}
		$cuser = $this->session->userdata('user');
		$dashboard = array();
		if ($cuser['level'] < 2) {
			//Cantidad de usuarios
			$dashboard['users_count'] = $this->MY_model->get_count('user', array('status' => 1));
			//Cantidad de Clientes
			$dashboard['clientes_count'] = $this->MY_model->get_count('clients', array('status' => 1));
			//Cantidad de prestamos
			$dashboard['prestamos_count'] = $this->MY_model->get_count('loans', array('status' => 1));
			$loans_dues = $this->MY_model->get_data(array('estado' => 'Pendiente'), 'loans_dues');
			//Cantidad de cuotas pendientes
			$dashboard['cuotas_count'] = $loans_dues ? count($loans_dues) : 0;
			//Array de prestamos por mes
			$prestamos_por_mes = $this->MY_model->get_query('SELECT * FROM (SELECT MONTH(`fecha_inicio`) AS `MES`, SUM(`monto`) AS `MONTO_SUMA` FROM `loans` GROUP BY `MES`) AS `MESES_SUMAS` WHERE `MES` <= MONTH(CURRENT_DATE) ORDER BY `MES` ASC LIMIT 7');
			if ($prestamos_por_mes) {
				foreach ($prestamos_por_mes as $key => $value) {
					$dashboard['prestamos_por_mes'][$value['MES']] = $value['MONTO_SUMA'];
				}
			} else {
				$dashboard['prestamos_por_mes'] = array();
			}
			//Array de ganancias por mes
			$ganancia_por_mes = $this->MY_model->get_query('SELECT * FROM (SELECT MONTH(`fecha_inicio`) AS `MES`, SUM(`subtotal`) AS `MONTO_SUMA` FROM `loans` GROUP BY `MES`) AS `MESES_SUMAS` WHERE `MES` <= MONTH(CURRENT_DATE) ORDER BY `MES` ASC LIMIT 7');
			if ($ganancia_por_mes) {
				foreach ($ganancia_por_mes as $key => $value) {
					$dashboard['ganancias_por_mes'][$value['MES']] = $value['MONTO_SUMA'];
				}
			} else {
				$dashboard['ganancias_por_mes'] = array();

			}
			//Cantidad de clientes en el mes actual
			$dashboard['clientes_count_this_month'] = $this->MY_model->get_query('SELECT COUNT(id) as `cuenta` FROM `clients` WHERE MONTH(registerdate)= MONTH(CURRENT_DATE)')[0]['cuenta'];
			$id = $this->session->userdata('user')['id'];
			//Cantidad de prestamos en el mes actual
			$dashboard['prestamos_count_this_month'] = $this->MY_model->get_query("SELECT COUNT(id) AS `total_prestamos_mes` FROM `loans` WHERE MONTH(registerdate)=MONTH(CURRENT_DATE)")[0]['total_prestamos_mes'];
			//Cantidad de usuarios nuevos en el mes actual
			$dashboard['user_count_month'] = $this->MY_model->get_query('SELECT COUNT(id) AS user_count_month FROM `user` WHERE MONTH(date_created)=MONTH(CURRENT_DATE)')[0]['user_count_month'];
			$loans_dues = $this->MY_model->get_data(array('estado' => 'Caida'), 'loans_dues');
			//Cantidad de cuotas pendientes
			$dashboard['count_dues_down'] = $loans_dues ? count($loans_dues) : 0;
		} else {
			//Cantidad de usuarios
			$dashboard['users_count'] = 0;
			//Cantidad de Clientes
			$dashboard['clientes_count'] = $this->MY_model->get_count('loans_user_client', array('id_user' => $cuser['id'], 'status' => 1));
			//Cantidad de prestamos
			$dashboard['prestamos_count'] = $this->MY_model->get_count('loans', array('id_prestamista' => $cuser['id'], 'status' => 1));

			$loans_dues = $this->MY_model->get_query('SELECT * FROM `loans_dues`, `loans` WHERE `loans_dues`.`id_prestamo`=`loans`.`id` AND `loans`.`id_prestamista`=' . $cuser['id']);
			//Cantidad de cuotas pendientes
			$dashboard['cuotas_count'] = $loans_dues ? count($loans_dues) : 0;
			//Array de prestamos por mes
			$prestamos_por_mes = $this->MY_model->get_query('SELECT * FROM (SELECT MONTH(`fecha_inicio`) AS `MES`, SUM(`monto`) AS `MONTO_SUMA` FROM `loans` WHERE `loans`.`id_prestamista`=' . $cuser['id'] . '  GROUP BY `MES`) AS `MESES_SUMAS` WHERE `MES` <= MONTH(CURRENT_DATE) ORDER BY `MES` ASC LIMIT 7');
			if ($prestamos_por_mes) {
				foreach ($prestamos_por_mes as $key => $value) {
					$dashboard['prestamos_por_mes'][$value['MES']] = $value['MONTO_SUMA'];
				}
			} else {
				$dashboard['prestamos_por_mes'] = array();
			}
			//Array de ganancias por mes
			$ganancia_por_mes = $this->MY_model->get_query('SELECT * FROM (SELECT MONTH(`fecha_inicio`) AS `MES`, SUM(`subtotal`) AS `MONTO_SUMA` FROM `loans` WHERE `loans`.`id_prestamista`=' . $cuser['id'] . ' GROUP BY `MES`) AS `MESES_SUMAS` WHERE `MES` <= MONTH(CURRENT_DATE) ORDER BY `MES` ASC LIMIT 7');
			if ($ganancia_por_mes) {
				foreach ($ganancia_por_mes as $key => $value) {
					$dashboard['ganancias_por_mes'][$value['MES']] = $value['MONTO_SUMA'];
				}
			} else {
				$dashboard['ganancias_por_mes'] = array();

			}
			//Cantidad de clientes en el mes actual
			$dashboard['clientes_count_this_month'] = $this->MY_model->get_query('SELECT COUNT(id) as `cuenta` FROM `clients` WHERE MONTH(`registerdate`)= MONTH(CURRENT_DATE)  AND `clients`.`id_user_register`=' . $cuser['id'])[0]['cuenta'];
			$id = $this->session->userdata('user')['id'];
			//Cantidad de prestamos en el mes actual
			$dashboard['prestamos_count_this_month'] = $this->MY_model->get_query("SELECT COUNT(id) AS `total_prestamos_mes` FROM `loans` WHERE MONTH(registerdate)=MONTH(CURRENT_DATE) AND `id_prestamista`=" . $cuser['id'])[0]['total_prestamos_mes'];
			//Cantidad de usuarios nuevos en el mes actual
			$dashboard['user_count_month'] = 0;
			$loans_dues = $this->MY_model->get_query("SELECT * FROM `loans_dues`, `loans` WHERE `loans_dues`.`id_prestamo`=`loans`.`id` AND `loans_dues`.`estado`='Caida' AND `loans`.`id_prestamista`=" . $cuser['id']);
			//Cantidad de cuotas caidas
			$dashboard['count_dues_down'] = $loans_dues ? count($loans_dues) : 0;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($dashboard));
	}

	public function ajax_get_notifications()
	{
		if ($this->config->item('enable_profiler')) {
			$this->output->enable_profiler(false);
		}
		$cuser = $this->session->userdata('user');
		$Notifications = $this->get_notifications($cuser['id']);
		$this->output->set_header('HTTP/1.0 200 OK');
		$this->output->set_status_header(200);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($Notifications));
	}
}
