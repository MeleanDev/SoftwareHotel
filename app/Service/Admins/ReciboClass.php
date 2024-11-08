<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class ReciboClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->ReciboLista();
        return $datos;
    }

    public function anular($datos, $id){
        $this->consultaDB->ReciboAnular($datos, $id);
    }


}
