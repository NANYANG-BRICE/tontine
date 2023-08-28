<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parametres extends Migration
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
            'raison_sociale' => [
                'type' => 'VARCHAR',
                'constraint' => '8',
                'null' => false,
                'unique' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'sigle' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'slogant' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'filigramme' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'facebook' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'twitter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'linkedin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'site_web' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ],
            'whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
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
            'entete_sms' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
                'null' => false,
            ],
            'solde_sms' => [
                'type' => 'INT',
                'default' => 100,
                'null' => false,
            ],
            'solde_email' => [
                'type' => 'INT',
                'default' => 100,
                'null' => false,
            ],
            'solde_whatsapp' => [
                'type' => 'INT',
                'default' => 100,
                'null' => false,
            ],
            'solde_telegram' => [
                'type' => 'INT',
                'default' => 1000,
                'null' => false,
            ],
            'montant_inscription_nouveau' => [
                'type' => 'INT',
                'default' => 3000,
                'null' => false,
            ],
            'montant_inscription_ancien' => [
                'type' => 'INT',
                'default' => 3000,
                'null' => false,
            ],
            'taux_annuel' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'null' => false,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
        $this->forge->createTable('parametre');

    }

    public function down()
    {
        $this->forge->dropTable('parametre');
    }
}