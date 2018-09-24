<?php 
class User_Group_model extends MY_model {

	public $id = FALSE;
    public $name;
    public $level;
    public $description;
	public $status;
	public $table_name = 'user_group';
	public $unique_colunms = array('name');
	
	static $user_roles = array(
        0 =>
            array(
                array('permision' => 'access_user_module',      'value' => '1'),
                array('permision' => 'view_list_user',          'value' => '1'),
                array('permision' => 'view_specific_user',      'value' => '1'),
                array('permision' => 'create_any_user',         'value' => '1'),
                array('permision' => 'update_any_user',         'value' => '1'),
                array('permision' => 'update_current_user',     'value' => '1'),
                array('permision' => 'update_status_user',      'value' => '1'),
                array('permision' => 'delete_any_user',         'value' => '1'),
                array('permision' => 'update_user_permision',   'value' => '1'),
            ),
        1 => 
            array(
                array('permision' => 'access_user_module',      'value' => '1'),
                array('permision' => 'view_list_user',          'value' => '1'),
                array('permision' => 'view_specific_user',      'value' => '1'),
                array('permision' => 'create_any_user',         'value' => '1'),
                array('permision' => 'update_any_user',         'value' => '1'),
                array('permision' => 'update_current_user',     'value' => '1'),
                array('permision' => 'update_status_user',      'value' => '1'),
                array('permision' => 'delete_any_user',         'value' => '1'),
                array('permision' => 'update_user_permision',   'value' => '0'),
            ),
        2 => 
            array(
                array('permision' => 'access_user_module',      'value' => '1'),
                array('permision' => 'view_list_user',          'value' => '1'),
                array('permision' => 'view_specific_user',      'value' => '0'),
                array('permision' => 'create_any_user',         'value' => '0'),
                array('permision' => 'update_any_user',         'value' => '0'),
                array('permision' => 'update_current_user',     'value' => '1'),
                array('permision' => 'update_status_user',      'value' => '0'),
                array('permision' => 'delete_any_user',         'value' => '0'),
                array('permision' => 'update_user_permision',   'value' => '0'),
            )
	);
	
    const LEVEL_ROOT    = 0;
    const LEVEL_ADMIN   = 1;
	const LEVEL_STANDAR = 2;
	
	static $user_groups = array(
		1 => array(
			'name' => 'Root',
			'level' => 0,
			'description' => 'All configurations allowed'
		),
		2 => array(
			'name' => 'Admin',
			'level' => 1,
			'description' => 'All permisions allowed'

		),
		3 => array(
			'name' => 'Standar',
			'level' => 2,
			'description' => 'Not delete permisions allowed'
		)
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function map($id)
	{
		$user_group = $this->get_data(array('id' => $id), $this->table_name)[0];
		if (!$user_group) {
			return FALSE;
        }
        
        $this->id 				= $id;
        $this->name 			= $user_group['name'];
        $this->level    		= $user_group['level'];
        $this->description  	= $user_group['description'];
        $this->status   		= $user_group['status'];

        return $this;

	}

	public function create($insert = false)
	{
        $data = $this->get_as_array();
        if (is_array($insert)) {
            $data = $insert;
        }
        foreach ($this->unique_colunms as $key => $value) {
            if($this->get_data(array((string)$value => (string)$data[$value]), $this->table_name)){
                return false;
            }
        }
        $this->set_data($data, $this->table_name);
        return false;
	}

	public function update()
	{
		return false;		
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
    
    public function get_as_array()
    {
        $date = new DateTime();        
        $data = array(
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'description' => $this->description,
            'status' => $this->status,
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        );
        return $data;
    }
}
?>