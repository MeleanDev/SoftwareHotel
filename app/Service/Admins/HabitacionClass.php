<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class HabitacionClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->HabitacionesLista();
        return $datos;
    }

    // public function listaModerador(){
    //     $datos = $this->consultaDB->HabitacionesListaModerador();;
    //     return $datos;
    // }

    public function crear($datos){
        $this->consultaDB->HabitacionesCrear($datos);
    }

    public function sedes()
    {
        $datos = $this->consultaDB->SedesLista();
        return $datos;
    }

    public function editar($datos, $id){
        $this->consultaDB->HabitacionesEditar($datos, $id);
    }

}