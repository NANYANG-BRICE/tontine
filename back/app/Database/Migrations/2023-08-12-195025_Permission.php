<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permission extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'BIGINT',
                    'constraint' => 255,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'parametre_id' => [
                    'type' => 'BIGINT',
                    'constraint' => 255,
                    'unsigned' => true,
                ],
                'role_id' => [
                    'type' => 'BIGINT',
                    'constraint' => 255,
                    'unsigned' => true,
                ],
                'module_id' => [
                    'type' => 'BIGINT',
                    'constraint' => 255,
                    'unsigned' => true,
                ],
                'read' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'create' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'update' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'delete' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'print' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'import' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'backup' => [
                    'type' => "ENUM",
                    'constraint' => "'true','false'",
                    'default' => 'false',
                    'null' => false
                ],
                'status' => [
                    'type' => "ENUM",
                    'constraint' => "'actif','inactif'",
                    'default' => 'actif',
                    'null' => false
                ],
                'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        );
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parametre_id', 'parametre', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('module_id', 'module', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('role_id', 'role', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('permission');

    }

    public function down()
    {
        $this->forge->dropTable('permission');
    }
}