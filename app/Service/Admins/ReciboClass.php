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
        // foreach ($datos as $item) {
        //     $busca = $id->id;

        //     $sede = recibo::whereHas('habitacione.sede', function ($query) use ($busca) {
        //         $query->where('id', $busca);
        //     })->first();
    
        //     $huesped = recibo::whereHas('habitacione.sede.huesped', function ($query) use ($busca) {
        //         $query->where('id', $busca);
        //     })->first();

        //     $datos-
        // }
        return $datos;
    }

    public function anular($datos, $id){
        $this->consultaDB->ReciboAnular($datos, $id);
    }


}
