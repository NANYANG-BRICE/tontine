<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Epargne extends Migration
{
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'matricule' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'utilisateur_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'montant' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
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
        $this->forge->addForeignKey('utilisateur_id', 'utilisateur', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('epargne');
    }

    public function down() {
        $this->forge->dropTable('epargne');
    }
}
