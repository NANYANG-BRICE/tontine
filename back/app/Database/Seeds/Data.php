<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Agapes;
use App\Models\Backups;
use App\Models\Emprunts;
use App\Models\Epargnes;
use App\Models\Inscriptions;
use App\Models\Messageries;
use App\Models\Modules;
use App\Models\Parametres;
use App\Models\Permissions;
use App\Models\Rembourcements;
use App\Models\Roles;
use App\Models\Tontines;
use App\Models\Transactions;
use App\Models\Utilisateurs;

class Data extends Seeder
{
    private $Agapes;
    private $Backups;
    private $Emprunts;
    private $Epargnes;
    private $Inscriptions;
    private $Messageries;
    private $Modules;
    private $Parametres;
    private $Permissions;
    private $Rembourcements;
    private $Roles;
    private $Tontines;
    private $Transactions;
    private $Utilisateurs;
    private $faker;



    public function __construct()
    {
        $this->Agapes = new Agapes();
        $this->Backups = new Backups;
        $this->Emprunts = new Emprunts;
        $this->Epargnes = new Epargnes;
        $this->Inscriptions = new Inscriptions;
        $this->Messageries = new Messageries;
        $this->Modules = new Modules;
        $this->Parametres = new Parametres;
        $this->Permissions = new Permissions;
        $this->Rembourcements = new Rembourcements;
        $this->Roles = new Roles;
        $this->Tontines = new Tontines;
        $this->Transactions = new Transactions;
        $this->Utilisateurs = new Utilisateurs;
        $this->faker = \Faker\Factory::create();
    }

    function fakeCompanie()
    {
        for ($i = 0; $i < 3; $i++) {
            $this->Parametres->save([
                'raison_sociale' => $this->faker->company,
                'nom' => $this->faker->company,
                'sigle' => $this->faker->word,
                'slogant' => $this->faker->sentence(3),
                'filigramme' => $this->faker->sentence(2),
                'logo' => $this->faker->imageUrl(360, 360, 'animals', true),
                'facebook' => $this->faker->url('http'),
                'twitter' => $this->faker->url('http'),
                'linkedin' => $this->faker->url('http'),
                'site_web' => $this->faker->url('http'),
                'whatsapp' => $this->faker->url('http'),
                'email' => $this->faker->companyEmail,
                'telephone' => $this->faker->e164PhoneNumber,
                'entete_sms' => $this->faker->word,
                'solde_sms' => 50,
                'solde_email' => 1000,
                'solde_whatsapp' => 100,
                'solde_telegram' => 1000,
                'taux_annuel' => round((rand(2, 8) / 100), 2),
                'janvier' => round((rand(2, 8) / 100), 2),
                'fevrier' => round((rand(2, 8) / 100), 2),
                'mars' => round((rand(2, 8) / 100), 2),
                'avril' => round((rand(2, 8) / 100), 2),
                'mai' => round((rand(2, 8) / 100), 2),
                'juin' => round((rand(2, 8) / 100), 2),
                'juillet' => round((rand(2, 8) / 100), 2),
                'aout' => round((rand(2, 8) / 100), 2),
                'septembre' => round((rand(2, 8) / 100), 2),
                'octobre' => round((rand(2, 8) / 100), 2),
                'novembre' => round((rand(2, 8) / 100), 2),
                'decembre' => round((rand(2, 8) / 100), 2),
                'description' => $this->faker->text(rand(10, 200)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s')
            ]);
        }
    }




    function fakeRoles()
    {
        $data = ['Président(e)', 'Vice-président(e)', 'Secrétaire', 'Trésorier(e)', 'Trésorier(e) adjoint', 'Membre', 'Administrateur', 'Inspecteur'];
        for ($i = 0; $i < count($data); $i++) {
            $this->Roles->save([
                'nom' => $data[$i],
                'description' => $this->faker->text(rand(10, 200)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeModules()
    {
        $data = ['inscriptions', 'tontines', 'agapes', 'emprunts', 'rembourcements', 'epargnes', 'intérêts', 'utilisateurs', 'sms', 'email', 'whatsapp', 'telegram', 'roles', 'modules', 'permissions', 'profil', 'association', 'paramètre'];
        for ($i = 0; $i < count($data); $i++) {
            $this->Modules->save(
                [
                    'nom' => $data[$i],
                    'sigle' => $data[$i],
                    'description' => $this->faker->text(rand(10, 200)),
                    'status' => 'actif',
                    'created_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s'),
                    'updated_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s')
                ]
            );
        }

    }




    function fakePermissions()
    {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                for ($k = 1; $k <= 18; $k++) {
                    $this->Permissions->save([
                        'parametre_id' => $i,
                        'role_id' => $j,
                        'module_id' => $k,
                        'read' => (rand(0, 1) == 0) ? 'true' : 'false',
                        'create' => (rand(0, 1) == 0) ? 'true' : 'false',
                        'update' => (rand(0, 1) == 0) ? 'true' : 'false',
                        'delete' => 'false',
                        'print' => (rand(0, 1) == 0) ? 'true' : 'false',
                        'import' => (rand(0, 1) == 0) ? 'true' : 'false',
                        'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                        'created_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s'),
                        'updated_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }




    function fakeUtilisateur()
    {
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 50; $j++) {
                $this->Utilisateurs->save([
                    'matricule' => $this->faker->bothify('user-#?#?#?-####'),
                    'parametre_id' => $i,
                    'role_id' => rand(1, 8),
                    'photo' => $this->faker->imageUrl(640, 480, 'animals', true),
                    'nom' => $this->faker->lastName,
                    'prenom' => $this->faker->firstName,
                    'sexe' => (rand(0, 1) == 0) ? 'masculin' : 'feminin',
                    'email' => (rand(0, 1) == 0) ? $this->faker->freeEmail : $this->faker->companyEmail(),
                    'telephone' => $this->faker->e164PhoneNumber,
                    'est_ancien' => (rand(0, 1) == 0) ? 'oui' : 'non',
                    'description' => $this->faker->text(rand(10, 180)),
                    'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                    'created_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s'),
                    'updated_at' => $this->faker->dateTimeBetween('-13 month', '-12 month')->format('Y-m-d H:i:s')
                ]);
            }
        }
    }



    function fakeEpargne()
    {
        $operateur = ['Orange Money', 'Mobile Money', 'Association'];
        for ($i = 0; $i < 1250; $i++) {
            $this->Epargnes->save([
                'matricule' => $this->faker->bothify('EP-?#?#?#?-?#?#?#?'),
                'utilisateur_id' => rand(1, 150),
                'telephone_emetteur' => '',
                'telephone_recepteur' => '',
                'transaction_id' => $this->faker->uuid(),
                'operateur' => $operateur[rand(0, 2)],
                'montant' => (rand(10, 250) * 10000),
                'etat_transaction' => 'validé',
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '+15 days')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '+14 days')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeInscription()
    {
        $operateur = ['Orange Money', 'Mobile Money', 'Association'];
        for ($i = 0; $i < 425; $i++) {
            $this->Inscriptions->save([
                'matricule' => $this->faker->bothify('INS--?#?#?#?-?#?#?#?'),
                'utilisateur_id' => rand(1, 150),
                'telephone_emetteur' => '',
                'telephone_recepteur' => '',
                'transaction_id' => $this->faker->uuid(),
                'operateur' => $operateur[rand(0, 2)],
                'montant' => (rand(10, 20) * 100),
                'etat_transaction' => 'validé',
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '-10 month')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '-10 month')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeAgape()
    {
        $operateur = ['Orange Money', 'Mobile Money', 'Association'];
        for ($i = 0; $i < 425; $i++) {
            $this->Agapes->save([
                'matricule' => $this->faker->bothify('AGP--?#?#?#?-?#?#?#?'),
                'utilisateur_id' => rand(1, 150),
                'telephone_emetteur' => '',
                'telephone_recepteur' => '',
                'transaction_id' => $this->faker->uuid(),
                'operateur' => $operateur[rand(0, 2)],
                'montant' => (rand(10, 15) * 100),
                'etat_transaction' => 'validé',
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '+5 days')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '+5 days')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeTontine()
    {
        $operateur = ['Orange Money', 'Mobile Money', 'Association'];
        for ($i = 0; $i < 2500; $i++) {
            $this->Tontines->save([
                'matricule' => $this->faker->bothify('TOT-?#?#?#?-?#?#?#?'),
                'utilisateur_id' => rand(1, 150),
                'telephone_emetteur' => '',
                'telephone_recepteur' => '',
                'transaction_id' => $this->faker->uuid(),
                'operateur' => $operateur[rand(0, 2)],
                'montant' => (rand(20, 500) * 1000),
                'etat_transaction' => 'validé',
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '+15 days')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '+14 days')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeEmprunt()
    {
        for ($i = 0; $i < 1850; $i++) {
            $this->Emprunts->save([
                'matricule' => $this->faker->bothify('EMP-?#?#?#?-?#?#?#?'),
                'utilisateur_id' => rand(1, 150),
                'transaction_id' => $this->faker->uuid(),
                'montant' => (rand(50, 500) * 1000),
                'etat_transaction' => 'validé',
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '+15 days')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '+14 days')->format('Y-m-d H:i:s')
            ]);
        }
    }



    function fakeRembourcement()
    {
        for ($i = 0; $i < 4250; $i++) {
            $this->Emprunts->save([
                'matricule' => $this->faker->bothify('RAM-?#?#?#?-?#?#?#?-?#?#?#?'),
                'emprunt_id' => rand(1, 1849),
                'transaction_id' => $this->faker->uuid(),
                'montant' => (rand(10, 50) * 1000),
                'description' => $this->faker->text(rand(10, 180)),
                'status' => (rand(0, 1) == 0) ? 'actif' : 'inactif',
                'created_at' => $this->faker->dateTimeBetween('-11 month', '+15 days')->format('Y-m-d H:i:s'),
                'updated_at' => $this->faker->dateTimeBetween('-11 month', '+14 days')->format('Y-m-d H:i:s')
            ]);
        }
    }



    public function run() 
    {
        /*$this->fakeCompanie();
        $this->fakeRoles();
        $this->fakeModules();
        $this->fakePermissions();
        $this->fakeUtilisateur();
        $this->fakeAgape();
        $this->fakeInscription();
        $this->fakeEpargne();
        $this->fakeEmprunt();
        $this->fakeTontine();
        $this->fakeRembourcement();*/
    }
}