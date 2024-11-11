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
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
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
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            $datos = $this->reciboClass->lista();
        }
        if ($user->hasRole('Moderador')) {
            $datos = $this->reciboClass->listaModerador($user->sede_id);
        }
        return datatables()->of($datos)->toJson();
    }

    public function descargar(Recibo $id)
    {
        if ($id->estado == 'Realizada') {
            $reserva = Reserva::find($id->reserva_id);
            $habitacion = Habitacione::find($reserva->habitacione_id);
            $sede = Sede::find($habitacion->sede_id);
            $usuario = User::find($reserva->user_id);


            $fecha_entrada = Carbon::parse($reserva->fecha_entrada);
            $fecha_salida = Carbon::parse($reserva->fecha_salida);
            $cantidadDias = $fecha_entrada->diffInDays($fecha_salida);

            // Reciboo
            $identificacionRecibo = $id->identificador;
            $fechaRecibo = $id->fecha_emision;
            $nombreSede = $sede->nombre;

            // Cliente
            $nombreCliente = $usuario->name . ' ' . $usuario->apellido;
            $identificacionCliente = $usuario->identificacion;

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
        return redirect()->route('recibos');
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
