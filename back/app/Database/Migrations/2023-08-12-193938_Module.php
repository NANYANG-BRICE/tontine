<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Module extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => false
            ],
            'sigle' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => false
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'rien à signaler',
            ],
            'status' => [
                'type' => "ENUM",
                'constraint' => "'actif','inactif'",
                'default' => 'actif',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('module');
    }

    public function down()
    {
        $this->forge->dropTable('module');
    }
}
