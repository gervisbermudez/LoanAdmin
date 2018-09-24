<?php

class UserSeeder extends Seeder {

    private $table = 'user';

    public function run() {
        
        $this->db->query('ALTER TABLE user_group AUTO_INCREMENT=1;');

        $date = new DateTime();
        $data = array(
        array(
            'name' => 'Root',
            'level' => 0,
            'description' => 'All permisions allowed',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        ),
        array(
            'name' => 'Admin',
            'level' => 1,
            'description' => 'All configurations allowed',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        ),
        array(
            'name' => 'Standar',
            'level' => 2,
            'description' => 'Not delete permisions allowed',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        )
        );
        $result = '<br>';
        if($this->db->insert_batch('user_group', $data)){
            $result .= "Seed user_group success\n";
        }

        $this->db->query('ALTER TABLE user AUTO_INCREMENT=1;');
        //Create users 
        $date = new DateTime();
        $data = array(
            array(
                'username' => 'root',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'email' => "root@email.com",
                'lastseen' => $date->format('Y-m-d H:i:s'),
                'id_user_group' => 1,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array(
                'username' => 'admin',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'email' => "admin@email.com",
                'lastseen' => $date->format('Y-m-d H:i:s'),
                'id_user_group' => 2,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array(
                'username' => 'user',
                'password' => password_hash("1234", PASSWORD_DEFAULT),
                'email' => "user@email.com",
                'lastseen' => $date->format('Y-m-d H:i:s'),
                'id_user_group' => 3,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '<br/>';
        if($this->db->insert_batch('user', $data)){
            $result .= 'Seed user success';
        }

        $this->db->query('ALTER TABLE user_permisions AUTO_INCREMENT=1;');

        $date = new DateTime();
        $this->load->model('User_Group_model');
        
        $ARR_LEVEL_ROOT = array();

        $LEVEL_ROOT = $this->User_Group_model::$user_roles[$this->User_Group_model::LEVEL_ROOT];
        foreach($LEVEL_ROOT as $key => $element){
            $LEVEL_ROOT[$key]['id_user'] = 1;
            $LEVEL_ROOT[$key]['module'] = 'User';
            $LEVEL_ROOT[$key]['created_from_ip'] = $this->input->ip_address();
            $LEVEL_ROOT[$key]['updated_from_ip'] = $this->input->ip_address();
            $LEVEL_ROOT[$key]['date_created'] = $date->format('Y-m-d H:i:s');
            $LEVEL_ROOT[$key]['date_updated'] = $date->format('Y-m-d H:i:s');
        }

        $result .= '<br/>';
        if($this->db->insert_batch('user_permisions', $LEVEL_ROOT)){
            $result .= 'Seed user_permisions success';
        }
        
        $LEVEL_ADMIN = $this->User_Group_model::$user_roles[$this->User_Group_model::LEVEL_ADMIN];
        foreach($LEVEL_ADMIN as $key => $element){
            $LEVEL_ADMIN[$key]['id_user'] = 2;
            $LEVEL_ADMIN[$key]['module'] = 'User';
            $LEVEL_ADMIN[$key]['created_from_ip'] = $this->input->ip_address();
            $LEVEL_ADMIN[$key]['updated_from_ip'] = $this->input->ip_address();
            $LEVEL_ADMIN[$key]['date_created'] = $date->format('Y-m-d H:i:s');
            $LEVEL_ADMIN[$key]['date_updated'] = $date->format('Y-m-d H:i:s');
        }
        $result .= '<br/>';
        if($this->db->insert_batch('user_permisions', $LEVEL_ADMIN)){
            $result .= 'Seed user_permisions success';
        }

        $LEVEL_STANDAR = $this->User_Group_model::$user_roles[$this->User_Group_model::LEVEL_STANDAR];
        foreach($LEVEL_STANDAR as $key => $element){
            $LEVEL_STANDAR[$key]['id_user'] = 3;
            $LEVEL_STANDAR[$key]['module'] = 'User';
            $LEVEL_STANDAR[$key]['created_from_ip'] = $this->input->ip_address();
            $LEVEL_STANDAR[$key]['updated_from_ip'] = $this->input->ip_address();
            $LEVEL_STANDAR[$key]['date_created'] = $date->format('Y-m-d H:i:s');
            $LEVEL_STANDAR[$key]['date_updated'] = $date->format('Y-m-d H:i:s');
        }

        $result .= '<br/>';
        if($this->db->insert_batch('user_permisions', $LEVEL_STANDAR)){
            $result .= 'Seed user_permisions success';
        }

        $this->db->query('ALTER TABLE user_data AUTO_INCREMENT=1;');

        //User Data Root
        $data = array(
            array('id_user' => 1,
                '_key' => 'nombre',
                '_value' => $this->faker->firstName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'apellido',
                '_value' => $this->faker->lastName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'direccion',
                '_value' => $this->faker->streetAddress,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'telefono',
                '_value' => $this->faker->phoneNumber,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'identificacion',
                '_value' => $this->faker->randomNumber(),
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'create by',
                '_value' => $this->faker->name,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 1,
                '_key' => 'avatar',
                '_value' => 'avatar.png',
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '<br/>';
        if($this->db->insert_batch('user_data', $data)){
            $result .= 'Seed user_data success';
        }

        //User Data Admin
        $data = array(
            array('id_user' => 2,
                '_key' => 'nombre',
                '_value' => $this->faker->firstName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'apellido',
                '_value' => $this->faker->lastName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'direccion',
                '_value' => $this->faker->streetAddress,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'telefono',
                '_value' => $this->faker->phoneNumber,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'identificacion',
                '_value' => $this->faker->randomNumber(),
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'create by',
                '_value' => $this->faker->name,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 2,
                '_key' => 'avatar',
                '_value' => 'avatar2.png',
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '<br/>';
        if($this->db->insert_batch('user_data', $data)){
            $result .= 'Seed user_data success';
        }
        
        //Single User Data 
        $data = array(
            array('id_user' => 3,
                '_key' => 'nombre',
                '_value' => $this->faker->firstName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'apellido',
                '_value' => $this->faker->lastName,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'direccion',
                '_value' => $this->faker->streetAddress,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'telefono',
                '_value' => $this->faker->phoneNumber,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'identificacion',
                '_value' => $this->faker->randomNumber(),
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'create by',
                '_value' => $this->faker->name,
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            ),
            array('id_user' => 3,
                '_key' => 'avatar',
                '_value' => 'avatar3.png',
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '<br/>';
        if($this->db->insert_batch('user_data', $data)){
            $result .= 'Seed user_data success';
        }
        echo $result.PHP_EOL;
    }
}
