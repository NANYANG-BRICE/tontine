<?php

namespace App\Controllers;

use App\Models\Roles;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Role extends ResourceController
{
    use ResponseTrait;
    private $roles;
    public function __construct()
    {
        $this->roles = new Roles();
    }

    public function response($status, $alert, $msg)
    {
        return $data = ['status' => $status, 'alert' => $alert, 'msg' => $msg];
    }

    public function index()
    {
        return $this->respond($this->roles->orderBy('created_at', 'DESC')->orderBy('nom', 'ASC')->orderBy('status', 'DESC')->findAll());
    }


    public function show($id = null)
    {
        return $this->respond($this->roles->find($id));
    }



    public function create()
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required|is_unique[role.nom]',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(408, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'nom' => $json->nom,
                'description' => $json->description
            ];

            if ($this->roles->insert($data) === false) {
                return $this->respond($this->response(409, "Désolé l'insertion du rôle de " . $data['nom'] . " a échoué", ""));
            }
            return $this->respond($this->response(200, "Le rôle de " . $data['nom'] . " a bien été enregistré", ""));
        }
    }



    public function update($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(408, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'nom' => $json->nom,
                'description' => $json->description,
            ];

            if ($this->roles->where('id', $id)->set($data)->update() === false) {
                return $this->respond($this->response(409, "Désolé les infos du rôle " . strtoupper($data['nom']) . " n'ont pas été modifiées", ""));
            }
            return $this->respond($this->response(200, "Le rôle " . strtoupper($data['nom']) . " a bien été modifiée", ""));
        }
    }


    public function deseable($id = null)
    {
        $account = $this->roles->find($id);
        $data = [
            'status' => 'inactif'
        ];
        if ($this->roles->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de désactiver le rôle " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le rôle " . $account['nom'] . " a bien été désactivé", ""));
    }


    public function enable($id = null)
    {
        $account = $this->roles->find($id);
        $data = [
            'status' => 'actif'
        ];
        if ($this->roles->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de réactiver le rôle " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le rôle " . $account['nom'] . " a bien été réactivé", ""));
    }


    public function delete($id = null)
    {
        $account = $this->roles->find($id);
        if ($this->roles->delete($id) === false) {
            return $this->respond($this->response(409, "Impossible de supprimer le rôle " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le rôle " . $account['nom'] . " a bien été supprimé", ""));
    }
}