<?php 
class Notifications_model extends MY_model {

    /*
        Default types
            Primary                     : Primary
            Info                        : Info
            Success                     : Success
            Warning                     : Warning
            Danger                      : Danger

        Modulo user
            Nuevo usuario               : new_user
            Nuevo prestamo              : new_loan
            Nueva cuota pagada          : new_due

        Modulo prestamo
            Cuota a cobrar hoy          : due_today
    */

    public $type = 'Primary';
    public $id_user;
    public $icons_class = array('Primary' => 'fa-bullhorn', 'Info' => 'fa-info', 'Success' => 'fa-check', 'Warning' => 'fa-warning', 'Danger' => 'fa-ban');
    public $template = '<a href="{action}"><i class="fa {icon} {color}"></i> {description}</a>';
    public $color_class = array('Primary' => 'text-muted', 'Info' => 'text-aqua', 'Success' => 'text-green', 'Warning' => 'text-yellow', 'Danger' => 'text-red');
    public $description = 'New notification';
    public $fecha = FALSE;
    public $code = FALSE;
    public $action = '#!';
    private $table_name = '`notifications`';

    function __construct()
    {
        parent::__construct();
    }

    public function generate()
    {
        $this->load->library('parser');
        $this->load->helper('string');

        $code = $this->code;
        if (!$code) {
            $code = random_string('alnum', 8);
        }

        $datetime = New DateTime();

        $dataparse = array( 'action' => $this->action, 
                            'icon' => $this->icons_class[$this->type], 
                            'color' =>$this->color_class[$this->type], 
                            'description' => $this->description
                            );

        $description = $this->parser->parse_string($this->template, $dataparse, TRUE);

        // If the fecha is not set them set with the now date time 
        $fecha = $this->fecha;
        if (!$this->fecha) {
            $fecha = $datetime->format('Y-m-d H:i:s');
        }

        $insert = array('id_user' => $this->id_user,
                        'codigo' => $code,
                        'description' => $description,
                        'fecha' => $fecha,
                        'fecha_registro' => $datetime->format('Y-m-d H:i:s'),
                        'type' => $this->type,
                        'isread' => '0',
                        'status' => '1');

        return $this->set_data($insert, $this->table_name);
    }

    public function get_notifications($select = FALSE, $limit = '25', $orderby = array('id', 'ASC'))
    {
        $today = New DateTime();

        // Default Select data 
        $selectData = array('id_user' => $this->id_user, 'isread' => '0', 'status' => '1');
        
        if (is_array($select)) {
            $selectData = array_merge($selectData, $select);
        }
        if ($selectData['isread'] === 'all') {
            unset($selectData['isread']);
        }
        switch ($select) {
            case 'today':
                $selectData['DATE(fecha)'] = $today->format('Y-m-d');
            break;
            case 'tomorrow':
                $tomorrow = $today->add(new DateInterval('P1D'));
                $selectData['DATE(fecha)'] = $tomorrow->format('Y-m-d');
            break;
            case 'yesterday':
                $yesterday = $today->sub(new DateInterval('P1D'));
                $selectData['DATE(fecha)'] = $yesterday->format('Y-m-d');
            break;
            case 'read':
                $selectData['isread'] = '1';
            break;            
            default:
                return $this->get_data($selectData, $this->table_name, $limit, $orderby);
            break;
        }

        return $this->get_data($selectData, $this->table_name, $limit, $orderby);
    }

    public function set_read($code = FALSE, $isread = '1')
    {
        if (!$code) {
            $code = $this->code;
        }
        $where = array('codigo' => $code);
        $data = array('isread' => $isread);
        return $this->update_data($where, $data, $this->table_name);
    }
    
}
?>