<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Messagerie extends Migration
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
            'matricule' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],
            'utilisateur_id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
            ],
            'objet' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'simple message de routine',
            ],
            'piece_jointe' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'rien à signaler',
            ],
            'status' => [
                'type' => "ENUM",
                'constraint' => "'en attente','envoyé','echec'",
                'default' => 'en attente',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('messagerie');
    }

    public function down()
    {
        $this->forge->dropTable('messagerie');
    }
}