<?php

class UserSeeder extends Seeder {

    private $table = 'user';

    public function run() {

        $this->db->truncate('user_group');
        $this->db->truncate('user');
        $this->db->truncate('user_permisions');
        $this->db->truncate('user_data');

        $this->db->query('ALTER TABLE `user` ADD CONSTRAINT `fk_id_user_group` FOREIGN KEY (`id_user_group`) REFERENCES `user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `user_permisions` ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `user_data` ADD CONSTRAINT `fk_id_user_on_user_data` FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
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
        $result = '\n';
        if($this->db->insert_batch('user_group', $data)){
            $result .= "Seed user_group success\n";
        }
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
        $result .= '';
        if($this->db->insert_batch('user', $data)){
            $result .= 'Seed user success';
        }
        $date = new DateTime();
        $data = array(array(
            'id_user' => 1,
            'permision' => 'access_user_module',
            'value' => 1,
            'module' => 'User',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        ),
        array(
            'id_user' => 2,
            'permision' => 'access_user_module',
            'value' => 1,
            'module' => 'User',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        ),
        array(
            'id_user' => 3,
            'permision' => 'access_user_module',
            'value' => 1,
            'module' => 'User',
            'created_from_ip' => $this->input->ip_address(),
            'updated_from_ip' => $this->input->ip_address(),
            'date_created' => $date->format('Y-m-d H:i:s'),
            'date_updated' => $date->format('Y-m-d H:i:s')
        )
        );
        $result .= '';
        if($this->db->insert_batch('user_permisions', $data)){
            $result .= 'Seed user_permisions success';
        }

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
                '_value' => $this->faker->e164PhoneNumber,
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
        $result .= '';
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
                '_value' => $this->faker->e164PhoneNumber,
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
                '_value' => 'avatar.png',
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '';
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
                '_value' => $this->faker->e164PhoneNumber,
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
                '_value' => 'avatar.png',
                'created_from_ip' => $this->input->ip_address(),
                'updated_from_ip' => $this->input->ip_address(),
                'date_created' => $date->format('Y-m-d H:i:s'),
                'date_updated' => $date->format('Y-m-d H:i:s')
            )
        );
        $result .= '';
        if($this->db->insert_batch('user_data', $data)){
            $result .= 'Seed user_data success';
        }
        echo $result.PHP_EOL;
    }
}
