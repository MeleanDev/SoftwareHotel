<?php

namespace App\Http\Controllers\Huesped;

use App\Http\Controllers\Controller;
use App\Service\Huesped\misReservacionesClass;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MisReservaciones extends Controller
{

    private $misReservas;

    public function __construct(misReservacionesClass $misReservas)
    {
        $this->misReservas = $misReservas;
    }


    public function index(): View
    {
        return view('software.pages.misReservas');
    }

    public function lista()
    {
        $datos = $this->misReservas->lista();
        return datatables()->of($datos)->toJson();
    }

    
}
