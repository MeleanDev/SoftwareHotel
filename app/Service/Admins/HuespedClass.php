<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class HuespedClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->UserListaHuesped();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->UserCrear($datos, 'Huesped');
    }

    public function editar($datos, $id){
        $this->consultaDB->UserEditarPanel($datos, $id);
    }
}
