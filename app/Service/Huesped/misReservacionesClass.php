<?php

namespace App\Service\Huesped;

use App\Service\DB\BDClass;

class misReservacionesClass
{
    private $consultaDB;

    public function __construct(BDClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->ReservaListaHuesped();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->ReservaCrear($datos);
    }

    public function habitaciones(){
        $datos = $this->consultaDB->habitacionesDisponibles();
        return $datos;
    }

    public function editar($datos, $id){
        $this->consultaDB->ReservaEditarHuesped($datos, $id);
    }

    
}
