<?php

namespace App\Service\Admins;

use App\Models\User;
use App\Service\DB\BDClass;

class ModeradorClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->UserListaModeradores();
        return $datos;
    }

    public function sedes()
    {
        $datos = $this->consultaDB->SedesLista();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->UserCrear($datos, 'Moderador');
    }

    public function editar($datos, $id){
        $this->consultaDB->UserEditarPanel($datos, $id);
    }

    public function detalle($id){
        $datos = User::where('id', $id)->with('sede')->get();
        return $datos;
    }
}
