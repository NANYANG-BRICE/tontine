<?php

namespace App\Controllers;
use App\Models\Modules;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Module extends ResourceController
{
    use ResponseTrait;
    private $modules;
    public function __construct()
    {
        $this->modules = new Modules();
    }

    public function response($status, $alert, $msg)
    {
        return $data = ['status' => $status, 'alert' => $alert, 'msg' => $msg];
    }

    public function index()
    {
        return $this->respond($this->modules->findAll());
    }


    public function show($id = null)
    {
        return $this->respond($this->modules->find($id));
    }



    public function create()
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required|is_unique[role.nom]',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'nom' => $json->nom,
                'sigle' => $json->sigle,
                'description' => $json->description,
            ];

            if ($this->modules->insert($data) === false) {
                return $this->respond($this->response(409, "Désolé l'insertion du module " . ($data['nom']) . " a échoué", ""));
            }
            return $this->respond($this->response(200, "Le module " . ($data['nom']) . " a bien été enregistré", ""));
        }
    }



    public function update($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'nom' => $json->nom,
                'sigle' => $json->sigle,
                'description' => $json->description,
            ];

            if ($this->modules->where('id', $id)->set($data)->update() === false) {
                return $this->respond($this->response(409, "Désolé les infos du module " . ($data['nom']) . " n'ont pas été modifiées", ""));
            }
            return $this->respond($this->response(200, "Le module " . ($data['nom']) . " a bien été modifiée", ""));
        }
    }


    public function deseable($id = null)
    {
        $account = $this->modules->find($id);
        $data = [
            'status' => 'inactif'
        ];
        if ($this->modules->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de désactiver le module " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le module " . $account['nom'] . " a bien été désactivé", ""));
    }


    public function enable($id = null)
    {
        $account = $this->modules->find($id);
        $data = [
            'status' => 'actif'
        ];
        if ($this->modules->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de réactiver le module " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le module " . $account['nom'] . " a bien été réactivé", ""));
    }


    public function delete($id = null)
    {
        $account = $this->modules->find($id);
        if ($this->modules->delete($id) === false) {
            return $this->respond($this->response(409, "Impossible de supprimer le module " . $account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le module " . $account['nom'] . " a bien été supprimé", ""));
    }
}