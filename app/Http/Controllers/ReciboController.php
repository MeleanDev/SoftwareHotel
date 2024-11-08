<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReciboRequest;
use App\Models\Recibo;
use App\Models\Reserva;
use App\Service\Admins\ReciboClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReciboController extends Controller
{
    private $reciboClass;

    public function __construct(ReciboClass $reciboClass)
    {
        $this->reciboClass = $reciboClass;
    }

    public function index(): view
    {
        return view('software.pages.recibos');
    }

    public function lista()
    {
        $datos = $this->reciboClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function descargar(Recibo $id)
    {
        
    }

    public function anular(ReciboRequest $dato, Reserva $id): JsonResponse
    {
        try {
            $this->reciboClass->anular($dato, $id);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true]);
        }
    }
        
}
