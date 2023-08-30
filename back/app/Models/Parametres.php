<?php

namespace App\Models;

use CodeIgniter\Model;

class Parametres extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'parametre';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'raison_sociale',
        'nom',
        'sigle',
        'slogant',
        'filigramme',
        'logo',
        'facebook',
        'twitter',
        'linkedin',
        'site_web',
        'whatsapp',
        'email',
        'telephone',
        'entete_sms',
        'solde_sms',
        'solde_email',
        'solde_whatsapp',
        'solde_telegram',
        'montant_inscription_nouveau',
        'montant_inscription_ancien',
        'taux_annuel',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
