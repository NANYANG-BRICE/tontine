<?php

namespace App\Controllers;

use App\Models\Permissions;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Permission extends ResourceController
{


    use ResponseTrait;
    private $permission;

    public function __construct()
    {
        $this->permission = new Permissions();
    }

    public function response($status, $alert, $msg)
    {
        return $data = ['status' => $status, 'alert' => $alert, 'msg' => $msg];
    }


    public function index()
    {
        $data = $this->permission
            ->join('parametre', 'parametre.id = permission.parametre_id')
            ->join('role', 'role.id = permission.role_id')
            ->join('module', 'module.id = permission.module_id')
            ->select('permission.*')
            ->select('module.nom as module, role.nom as role, parametre.raison_sociale as association')
            ->orderBy('association', 'ASC')
            ->orderBy('role', 'ASC')
            ->orderBy('module', 'ASC')
            ->findAll();
        return $this->respond($data);
    }


    public function deseable($id = null)
    {
        $data = [
            'status' => 'inactif'
        ];
        if ($this->permission->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de désactiver cette permission", ""));
        }
        return $this->respond($this->response(200, "Permission désactivée avec succès", ""));
    }


    public function update($id = null)
    {
        $json = $this->request->getJSON();
        $data = [
            'read' => $json->read,
            'create' => $json->create,
            'update' => $json->update,
            'delete' => $json->delete,
            'print' => $json->print,
            'import' => $json->import,
            'backup' => $json->backup
        ];
        if ($this->permission->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de modifier cette permission", ""));
        }
        return $this->respond($this->response(200, "La permission a été modifiée avec succès", ""));
    }


    public function enable($id = null)
    {
        $data = [
            'status' => 'actif'
        ];
        if ($this->permission->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de réactiver cette permission", ""));
        }
        return $this->respond($this->response(200, "Permission réactivée avec succès", ""));
    }


    public function delete($id = null)
    {
        if ($this->permission->delete($id) === false) {
            return $this->respond($this->response(409, "Impossible de supprimer cette permission", ""));
        }
        return $this->respond($this->response(200, "Permission supprimée avec succès", ""));
        ;
    }
}