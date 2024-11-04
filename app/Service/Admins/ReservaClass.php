<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class ReservaClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function habitaciones(){
        $datos = $this->consultaDB->habitacionesDisponibles();
        return $datos;
    }

    public function huesped(){
        $datos = $this->consultaDB->UserListaHuesped();
        return $datos;
    }

    public function lista(){
        $datos = $this->consultaDB->ReservaListaAdmin();
        return $datos;
    }

    public function crear($datos){
        $datos = $this->consultaDB->ReservaCrearTrabajador($datos);
        return $datos;
    }

    public function verificarActiva($id){
        $datos = $this->consultaDB->ReservaVerificarActiva($id);
        if ($datos == true) {
            return 'verdadero';
        }
        return 'falso';
    }

    public function habitacionLibre($id)
    {
        $this->consultaDB->HabitacionesEstado($id, 'disponible');
    }

    public function Ocupar($id)
    {
        $this->consultaDB->HabitacionesEstado($id, 'Ocupada');
    }

}
