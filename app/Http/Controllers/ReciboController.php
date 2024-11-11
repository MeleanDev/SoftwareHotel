<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Habitacione;
use App\Models\Recibo;
use App\Models\Reserva;
use App\Models\Sede;
use App\Models\User;
use App\Service\Admins\ReciboClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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

    public function descargar(Recibo $id) {
        $reserva = Reserva::find($id->reserva_id);
        $habitacion = Habitacione::find($reserva->habitacione_id);
        $sede = Sede::find($habitacion->sede_id);
        $usuario = User::find($reserva->user_id);


        $fecha_entrada = Carbon::parse($reserva->fecha_entrada);
        $fecha_salida = Carbon::parse($reserva->fecha_salida);
        $cantidadDias = $fecha_entrada->diffInDays($fecha_salida);
        
        // Reciboo
        $identificacionRecibo = now();
        $fechaRecibo = Carbon::now();
        $nombreSede = $sede->nombre;

        // Cliente
        $nombreCliente = $usuario->name . ' ' . $usuario->apellido;
        $identificacionCliente = $usuario->identificacion;

        // Tabla Producto o Servicio
        $habitacionNombre = $habitacion->identificador;
        $tipo = $habitacion->tipo;
        $cantidad = $cantidadDias;
        $precioUnit = $habitacion->precio;
        $totalAPagar = $precioUnit * $cantidadDias;

        $pdf = Pdf::loadView('software.componet.recibo', [
            'identificacionRecibo' => $identificacionRecibo,
            'fechaRecibo' => $fechaRecibo,
            'nombreSede' => $nombreSede,
            'nombreCliente' => $nombreCliente,
            'identificacionCliente' => $identificacionCliente,
            'entrada' => $fecha_entrada,
            'salida' => $fecha_salida,
            'habitacion' => $habitacionNombre,
            'tipo' => $tipo,
            'cantidad' => $cantidad,
            'precioUnit' => $precioUnit,
            'totalAPagar' => $totalAPagar,
        ]);

        return $pdf->stream();
    }

    public function anular(Recibo $id): JsonResponse
    {
        try {
            $this->reciboClass->anular($id);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true]);
        }
    }
}
