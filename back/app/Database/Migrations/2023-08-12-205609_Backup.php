<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Backup extends Migration
{
    public function up() {
        $this->forge->addField([
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
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
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
                'null' => false,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('parametre_id', 'parametre', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('sauvegarde');
    }

    public function down() {
        $this->forge->dropTable('sauvegarde');
    }
}
