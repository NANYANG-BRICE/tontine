<?php

namespace App\Controllers;

use App\Models\Parametres;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Parametre extends ResourceController
{
    use ResponseTrait;
    private $parametres;
    public function __construct()
    {
        $this->parametres = new Parametres();
    }

    public function response($status, $alert, $msg)
    {
        return $data = ['status' => $status, 'alert' => $alert, 'msg' => $msg];
    }

    public function index()
    {
        return $this->respond($this->parametres->findAll());
    }


    public function show($id = null)
    {
        return $this->respond($this->parametres->find($id));
    }


    public function create()
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required',
            'email' => 'required|valid_email|is_unique[parametre.email]',
            'telephone' => 'required|is_unique[parametre.telephone]',
            'raison_sociale' => 'required|is_unique[parametre.raison_sociale]',
            'sigle' => 'required|is_unique[parametre.sigle]',
            'slogant' => 'required|is_unique[parametre.slogant]',
            'filigramme' => 'required|is_unique[parametre.filigramme]',
            'logo' => 'required|is_unique[parametre.logo]',
            'facebook' => 'required|is_unique[parametre.facebook]',
            'twitter' => 'required|is_unique[parametre.twitter]',
            'linkedin' => 'required|is_unique[parametre.linkedin]',
            'site_web' => 'required|is_unique[parametre.site_web]',
            'whatsapp' => 'required|is_unique[parametre.whatsapp]',
            'entete_sms' => 'required|is_unique[parametre.entete_sms]',
        ];

        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'raison_sociale' => $json->raison_sociale,
                'nom' => $json->nom,
                'sigle' => $json->sigle,
                'slogant' => $json->slogant,
                'filigramme' => $json->filigramme,
                'logo' => $json->logo,
                'facebook' => $json->facebook,
                'twitter' => $json->twitter,
                'linkedin' => $json->linkedin,
                'site_web' => $json->site_web,
                'whatsapp' => $json->whatsapp,
                'email' => $json->email,
                'telephone' => $json->telephone,
                'entete_sms' => $json->entete_sms,
                'solde_sms' => $json->solde_sms,
                'solde_email' => $json->solde_email,
                'solde_whatsapp' => $json->solde_whatsapp,
                'solde_telegram' => $json->solde_telegram,
                'taux_annuel' => $json->taux_annuel,
                'janvier' => $json->janvier,
                'fevrier' => $json->fevrier,
                'mars' => $json->mars,
                'avril' => $json->avril,
                'mai' => $json->mai,
                'juin' => $json->juin,
                'juillet' => $json->juillet,
                'aout' => $json->aout,
                'septembre' => $json->septembre,
                'octobre' => $json->octobre,
                'novembre' => $json->novembre,
                'decembre' => $json->decembre,
                'description' => $json->description,
                'status' => 'actif',
            ];

            if ($this->parametres->insert($data) === false) {
                return $this->respond($this->response(409, "Désolé l'insertion de l'association " . strtoupper($data['nom']) . " a échouée", ""));
            }
            return $this->respond($this->response(200, "L'association " . strtoupper($data['nom']) . " a bien été enregistrée", ""));
        }
    }


    public function update($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'nom' => 'required',
            'email' => 'required|valid_email',
            'telephone' => 'required',
            'raison_sociale' => 'required',
            'sigle' => 'required',
            'slogant' => 'required',
            'filigramme' => 'required',
            'logo' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'site_web' => 'required',
            'whatsapp' => 'required',
            'entete_sms' => 'required',
        ];
        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez la conformité des champs remplis", $this->validator->getErrors()));
        } else {
            $json = $this->request->getJSON();
            $data = [
                'raison_sociale' => $json->raison_sociale,
                'nom' => $json->nom,
                'sigle' => $json->sigle,
                'slogant' => $json->slogant,
                'filigramme' => $json->filigramme,
                'logo' => $json->logo,
                'facebook' => $json->facebook,
                'twitter' => $json->twitter,
                'linkedin' => $json->linkedin,
                'site_web' => $json->site_web,
                'whatsapp' => $json->whatsapp,
                'email' => $json->email,
                'telephone' => $json->telephone,
                'entete_sms' => $json->entete_sms,
                'solde_sms' => $json->solde_sms,
                'solde_email' => $json->solde_email,
                'solde_whatsapp' => $json->solde_whatsapp,
                'solde_telegram' => $json->solde_telegram,
                'taux_annuel' => $json->taux_annuel,
                'janvier' => $json->janvier,
                'fevrier' => $json->fevrier,
                'mars' => $json->mars,
                'avril' => $json->avril,
                'mai' => $json->mai,
                'juin' => $json->juin,
                'juillet' => $json->juillet,
                'aout' => $json->aout,
                'septembre' => $json->septembre,
                'octobre' => $json->octobre,
                'novembre' => $json->novembre,
                'decembre' => $json->decembre,
                'description' => $json->description,
            ];

            if ($this->parametres->where('id', $id)->set($data)->update() === false) {
                return $this->respond($this->response(409, "Désolé les infos de cette association n'ont pas été modifiées", ""));
            }
            return $this->respond($this->response(200, "L'association " . strtoupper($data['nom']) . " a bien été modifiée", ""));
        }
    }


    function uploadlogo($id = null)
    {
        helper(['form', 'url']);
        $validations = [
            'logo' => [
                'uploaded[logo]',
                'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[logo,4096]',
            ],
        ];
        if (!$this->validate($validations)) {
            return $this->respond($this->response(400, "Vérifiez d\'abord la conformité votre image", $this->validator->getErrors()));
        } else {
            $file = $this->request->getFile('logo');
            $profile_image = $file->getName();
            $temp = explode(".", $profile_image);
            $path = 'images/uploads/association/';
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if ($file->move(WRITEPATH . $path)) {
                $data = ['logo' => $path . $newfilename];
                if ($this->parametres->where('id', $id)->set($data)->update() === false) {
                    return $this->respond($this->response(409, "L'importation du logo a échoué", ""));
                }
                return $this->respond($this->response(200, "Le logo a bien été importée", ""));
            } else {
                return $this->respond($this->response(409, "Désolé, il est mpossible pour nous d'importer votre logo.", ""));
            }
        }

    }


    public function deseable($id = null)
    {
        $account = $this->parametres->find($id);
        $data = [
            'status' => 'inactif'
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de désactiver le compte de de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Compte de l'association ".$account['nom']." a bien été désactivé", ""));
    }


    public function enable($id = null)
    {
        $account = $this->parametres->find($id);
        $data = [
            'status' => 'actif'
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible de réactiver le compte de de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Compte de l'association ".$account['nom']." a bien été réactivé", ""));
    }


    public function delete($id = null)
    {
        $account = $this->parametres->find($id);
        if ($this->parametres->delete($id) === false) {
            return $this->respond($this->response(409, "Impossible de supprimer le compte de de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Compte de l'association ".$account['nom']." a bien été supprimé", ""));
    }


    public function addSoldeSms($id = null, $solde = null)
    {
        $account = $this->parametres->find($id);
        $sms = intval($account['solde_sms']) + intval($solde);
        $data = [
            'solde_sms' => $sms
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible d'approvisionner le solde SMS de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le solde SMS de l'association ".$account['nom']." a bien été réapprovisioné de ".$solde." SMS", ""));
    }


    public function addSoldeEmail($id = null, $solde = null)
    {
        $account = $this->parametres->find($id);
        $sms = intval($account['solde_email']) + intval($solde);
        $data = [
            'solde_email' => $sms
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible d'approvisionner le solde Email de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le solde Email de l'association ".$account['nom']." a bien été réapprovisioné de ".$solde." Email", ""));
    }


    public function addSoldeWhatsapp($id = null, $solde = null)
    {
        $account = $this->parametres->find($id);
        $sms = intval($account['solde_whatsapp']) + intval($solde);
        $data = [
            'solde_whatsapp' => $sms
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible d'approvisionner le solde Whatsapp de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le solde Whatsapp de l'association ".$account['nom']." a bien été réapprovisioné de ".$solde." message(s) Whatsapp", ""));
    }


    public function addSoldeTelegram($id = null, $solde = null)
    {
        $account = $this->parametres->find($id);
        $sms = intval($account['solde_telegram']) + intval($solde);
        $data = [
            'solde_telegram' => $sms
        ];
        if ($this->parametres->where('id', $id)->set($data)->update() === false) {
            return $this->respond($this->response(409, "Impossible d'approvisionner le solde Telegram de l'association ".$account['nom'], ""));
        }
        return $this->respond($this->response(200, "Le solde Telegram de l'association ".$account['nom']." a bien été réapprovisioné de ".$solde." message(s) Telegram", ""));
    }

}