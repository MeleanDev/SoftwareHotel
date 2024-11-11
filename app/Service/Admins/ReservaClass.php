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

    public function habitacionesModerador($sede){
        $datos = $this->consultaDB->habitacionesDisponiblesModerador($sede);
        return $datos;
    }

    public function huesped(){
        $datos = $this->consultaDB->UserListaHuesped();
        return $datos;
    }

    public function listaAdmin(){
        $datos = $this->consultaDB->ReservaListaAdmin();
        return $datos;
    }
    public function listaModerador($sede){
        $datos = $this->consultaDB->ReservasModeradorLista($sede);
        foreach ($datos as $item) {
            $item->user_id = $this->consultaDB->buscarUserID($item->user_id);
            $item->habitacione_id = $this->consultaDB->buscarHabitacionID($item->habitacione_id);
        }
        return $datos;
    }

    public function crear($datos){
        $datos = $this->consultaDB->ReservaCrearTrabajador($datos);
        return $datos;
    }

    public function editar($datos, $id){
        $datos = $this->consultaDB->ReservaEditar($datos, $id);
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

    public function recibo($id){
        $this->consultaDB->ReciboCrear($id);
    }

}
