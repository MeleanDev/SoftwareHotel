<?php

namespace App\Http\Controllers\Huesped;

use App\Http\Controllers\Controller;
use App\Models\Habitacione;
use App\Models\Recibo;
use App\Models\Reserva;
use App\Models\Sede;
use App\Service\Huesped\MisReciboClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MisReciboController extends Controller
{
    private $misRecibos;

    public function __construct(MisReciboClass $misRecibos)
    {
        $this->misRecibos = $misRecibos;
    }

    public function index(): View
    {
        return view('software.pages.misRecibos');
    }

    public function lista()
    {
        $datos = $this->misRecibos->lista();
        foreach ($datos as $item) {
            $reserva = Reserva::find($item->reserva_id);
            $item->reserva_id = $reserva->identificador;
        }
        return datatables()->of($datos)->toJson();
    }

    public function descargar(Recibo $id)
    {
        if ($id->estado == 'Realizada') {
            $reserva = Reserva::find($id->reserva_id);
            if ($reserva->user_id == Auth::user()->id) {
                $habitacion = Habitacione::find($reserva->habitacione_id);
                $sede = Sede::find($habitacion->sede_id);

                $fecha_entrada = Carbon::parse($reserva->fecha_entrada);
                $fecha_salida = Carbon::parse($reserva->fecha_salida);
                $cantidadDias = $fecha_entrada->diffInDays($fecha_salida);

                // Reciboo
                $identificacionRecibo = $id->identificador;
                $fechaRecibo = $id->fecha_emision;
                $nombreSede = $sede->nombre;

                // Cliente
                $nombreCliente = Auth::user()->name . ' ' . Auth::user()->apellido;
                $identificacionCliente = Auth::user()->identificacion;

                // Tabla Producto o Servicio
                $habitacionNombre = $habitacion->identificador;
                $tipo = $habitacion->tipo;
                $cantidad = $cantidadDias;
                $precioUnit = $habitacion->precio;
                $totalAPagar = $id->monto;

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
            return redirect()->route('misRecibos');
        }
        return redirect()->route('misRecibos');
    }
}
