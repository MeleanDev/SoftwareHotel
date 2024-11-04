<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class AdminsClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->UserListaAdministradores();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->UserCrear($datos, 'Administrador');
    }

    public function editar($datos, $id){
        $this->consultaDB->UserEditarPanel($datos, $id);
    }
}
