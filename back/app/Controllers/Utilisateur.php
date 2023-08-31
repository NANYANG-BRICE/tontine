<?php

namespace App\Controllers;

use Faker\Factory;
use App\Models\Utilisateurs;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Utilisateur extends ResourceController
{
    use ResponseTrait;
    private $utilisateur;
    private $faker;
    public function __construct()
    {
        $this->utilisateur = new Utilisateurs();
        $this->faker = Factory::create();
    }

    public function response($status, $alert, $msg)
    {
        return $data = ['status' => $status, 'alert' => $alert, 'msg' => $msg];
    }


    public function actifs()
    {
        $data = $this->utilisateur
            ->join('parametre', 'parametre.id = utilisateur.parametre_id ')
            ->join('role', 'role.id = utilisateur.role_id ')
            ->select('utilisateur.*')
            ->select('role.nom as nom_role, parametre.nom as nom_utilisateur, parametre.raison_sociale')
            ->where('role.status', 'actif')
            ->where('parametre.status', 'actif')
            ->where('utilisateur.status', 'actif')
            ->findAll();
        return $this->respond($data);
    }


    public function index()
    {
        $data = $this->utilisateur
            ->join('parametre', 'parametre.id = utilisateur.parametre_id ')
            ->join('role', 'role.id = utilisateur.role_id ')
            ->select('utilisateur.*')
            ->select('role.nom as nom_role, parametre.nom as nom_utilisateur, parametre.raison_sociale')
            ->where('parametre.status', 'actif')
            ->findAll();
        return $this->respond($data);
    }


    public function show($id = null)
    {
        $data = $this->utilisateur
            ->join('parametre', 'parametre.id = utilisateur.parametre_id ')
            ->join('role', 'role.id = utilisateur.role_id ')
            ->select('utilisateur.*')
            ->select('role.nom as nom_role, parametre.nom as nom_utilisateur, parametre.raison_sociale')
            ->where('parametre.status', 'actif')
            ->where('utilisateur.id', $id)
            ->findAll();
        return $this->respond($data);
    }



    public function create()
    {
        helper(['form', 'url']);
        $validations = [
            'parametre_id' => 'required',
            'role_id' => 'required',
            'nom' => 'required',
            'sexe' => 'required',
            'email' => 'required|valid_email|is_unique[utilisateur.email]',
            'telephone' => 'required|integer|is_unique[utilisateur.telephone]',
            'est_ancien' => 'required',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $exist = $this->utilisateur->where('nom', $json->nom)->where('prenom', $json->prenom)->first();
            if ($exist) {
                return $this->respond($this->response(400, "Désolé ce nom d'utilisateur est déjà utilisé", ""));
            } else {
                $data = [
                    'matricule' => $this->faker->bothify('user-#?#?#?#-####'),
                    'parametre_id' => $json->parametre_id,
                    'role_id' => $json->role_id,
                    'nom' => $json->nom,
                    'prenom' => $json->prenom,
                    'sexe' => $json->sexe,
                    'email' => $json->email,
                    'telephone' => $json->telephone,
                    'est_ancien' => $json->est_ancien,
                    'description' => $json->description,
                    'status' => 'actif'
                ];

                if ($this->utilisateur->insert($data) === false) {
                    return $this->respond($this->response(409, "Désolé l'insertion de l'utilisateur " . strtoupper($data['nom'] . " " . $data['prenom']) . " a échoué", ""));
                }
                return $this->respond($this->response(200, "L'utilisateur " . strtoupper($data['nom'] . " " . $data['prenom']) . " a bien été enregistré", ""));
            }
        }
    }



    public function update($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'parametre_id' => 'required',
            'role_id' => 'required',
            'nom' => 'required',
            'sexe' => 'required',
            'email' => 'required|valid_email',
            'telephone' => 'required',
            'est_ancien' => 'required',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'role_id' => $json->role_id,
                'nom' => $json->nom,
                'prenom' => $json->prenom,
                'sexe' => $json->sexe,
                'email' => $json->email,
                'telephone' => $json->telephone,
                'est_ancien' => $json->est_ancien,
                'description' => $json->description,
            ];

            if ($this->utilisateur->where('id', $id)->set($data)->update() === false) {
                return $this->respond($this->response(409, "Désolé l de l'utilisateur " . strtoupper($data['nom'] . " " . $data['prenom']) . " a échoué", ""));
            }
            return $this->respond($this->response(200, "L'utilisateur " . strtoupper($data['nom'] . " " . $data['prenom']) . " a bien été enregistré", ""));
        }
    }


    function uploadPhoto($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'photo' => [
                'uploaded[photo]',
                'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[photo,4096]',
            ],
        ];
        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez d\'abord la conformité votre image", $this->validator->getErrors()));
        } else {
            $file = $this->request->getFile('photo');
            $profile_image = $file->getName();
            $temp = explode(".", $profile_image);
            $path = 'images/uploads/utilisateurs/';
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if ($file->move(WRITEPATH . $path)) {
                $data = ['photo' => $path . $newfilename];
                if ($this->utilisateur->where('id', $id)->set($data)->update() === false) {
                    return $this->respond($this->response(409, "L'importation de la photo a échoué", ""));
                }
                return $this->respond($this->response(200, "La photo a bien été importée", ""));
            } else {
                return $this->respond($this->response(409, "Désolé, il est mpossible pour nous d'importer votre image.", ""));
            }
        }

    }


    public function deseable($id = null)
    {
        $account = $this->utilisateur->find($id);
        $data = [
            'status' => 'inactif'
        ];
        if ($this->utilisateur->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de désactiver le compte de de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']), ""));
        }
        return $this->respond($this->response(200, "Compte de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']) . " a bien été désactivé", ""));
    }


    public function enable($id = null)
    {
        $account = $this->utilisateur->find($id);
        $data = [
            'status' => 'actif'
        ];
        if ($this->utilisateur->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de réactiver le compte de de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']), ""));
        }
        return $this->respond($this->response(200, "Compte de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']) . " a bien été réactivé", ""));
    }


    public function delete($id = null)
    {
        $account = $this->utilisateur->find($id);
        if ($this->utilisateur->delete($id) === false) {
            return $this->respond($this->response(409, "Impossible de supprimer le compte de de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']), ""));
        }
        return $this->respond($this->response(200, "Compte de l'utilisateur " . strtoupper($account['nom'] . " " . $account['prenom']) . " a bien été supprimé", ""));
    }
}