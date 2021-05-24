<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use CodeIgniter\Model;
use App\Entity\LogJeton;

/**
 * Description of ModelLogsJetons
 *
 * @author michel
 */
class ModelLogsJetons extends Model{
    protected $table = 'logs_jetons';
    protected $primaryKey = 'id_logs_jetons';
    protected $allowedFields = [
       'id_jetons', 'methode_logs_jetons'
    ];
    //protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $returnType    = LogJeton::Class;
}
