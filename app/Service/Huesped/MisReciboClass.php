<?php

namespace App\Service\Huesped;

use App\Service\DB\BDClass;

class MisReciboClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->ReciboHuesped();
        return $datos;
    }
}
