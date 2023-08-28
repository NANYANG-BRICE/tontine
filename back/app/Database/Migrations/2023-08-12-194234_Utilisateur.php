<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Utilisateur extends Migration
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
                'unique' => true,
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
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'prenom' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'sexe' => [
                'type' => 'ENUM',
                'constraint' => "'masculin','feminin'",
                'default' => 'masculin',
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => false,
            ],
            'est_ancien' => [
                'type' => "ENUM",
                'constraint' => "'oui','non'",
                'default' => 'non',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'rien à signaler',
                'null' => true,
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
        $this->forge->addForeignKey('parametre_id', 'parametre', 'id', 'CASCADE', 'NULL');
        $this->forge->addForeignKey('role_id', 'role', 'id', 'CASCADE', 'NULL');
        $this->forge->createTable('utilisateur');
    }

    public function down()
    {
        $this->forge->dropTable('utilisateur');
    }
}