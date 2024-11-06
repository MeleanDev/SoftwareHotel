<?php

namespace App\Service\Admins;

use App\Service\DB\BDClass;

class DashboardClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function habitaciones(){
        $datos = $this->consultaDB->HabitacionesCount();
        return $datos;
    }

    public function reservas(){
        $datos = $this->consultaDB->ReservasCount();
        return $datos;
    }

    public function huesped(){
        $datos = $this->consultaDB->UserHuespedCount();
        return $datos;
    }
}
