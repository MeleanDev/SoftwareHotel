<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class SedeClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->SedesLista();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->SedesCrear($datos);
    }

    public function editar($datos, $id){
        $this->consultaDB->SedesEditar($datos, $id);
    }

    public function detalle($id){
        $datos = $this->consultaDB->SedeDetalle($id);
        return $datos;
    }
}
