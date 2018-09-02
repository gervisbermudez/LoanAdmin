<?php

class Migration_user extends CI_Migration {

    public function up() {
        //Table user_group
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
                'null' => FALSE
            ),
            'level' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'created_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_created' => array(
                'type' => 'DATETIME'
            ),
            'date_updated' => array(
                'type' => 'DATETIME'
            ),
            'status' => array(
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_group');
        
        //Table User
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
                'null' => FALSE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE,
                'null' => FALSE
            ),
            'lastseen' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'id_user_group' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'created_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_created' => array(
                'type' => 'DATETIME'
            ),
            'date_updated' => array(
                'type' => 'DATETIME'
            ),
            'status' => array(
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user');

        //Table user_permisions
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'permision' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'value' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            'module' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'created_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_created' => array(
                'type' => 'DATETIME'
            ),
            'date_updated' => array(
                'type' => 'DATETIME'
            ),
            'status' => array(
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_permisions');

         //Table user_data
         $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            '_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => FALSE
            ),
            '_value' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE
            ),
            'created_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'updated_from_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_created' => array(
                'type' => 'DATETIME'
            ),
            'date_updated' => array(
                'type' => 'DATETIME'
            ),
            'status' => array(
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_data');
    }

    public function down() {
        $this->dbforge->drop_table('user');
        $this->dbforge->drop_table('user_permisions');
    }

}