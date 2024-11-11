<?php

namespace App\Service\Admins;

use App\Models\Habitacione;
use App\Models\Sede;
use App\Models\User;
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
        foreach ($datos as $item) {
            $sede = Habitacione::with('sede')->find($item->Reserva->habitacione_id);
            $user = User::find($item->Reserva->user_id);
            $item->sede = $sede->sede->nombre;
            $item->user = $user->identificacion;
        }
        return $datos;
    }

    public function anular($id){
        $this->consultaDB->ReciboAnular($id);
    }

}
