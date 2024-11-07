<?php

namespace App\Http\Controllers\Huesped;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservaHuespedRequest;
use App\Models\Reserva;
use App\Service\Huesped\misReservacionesClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MisReservascionesController extends Controller
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

    public function listaHabitaciones(Request $request): JsonResponse
    {
        $habitaciones = $this->misReservas->habitaciones();

        $term = $request->get('term');

        $results = [];

        foreach ($habitaciones as $item) {
            if (stristr($item->identificador, $term)) {
                $results[] = [
                    'habitacionId' => $item->id,
                    'habitacionText' => "Sede:  " . $item->sede->nombre . " ||  Habitacion:  " . $item->identificador . " || Tipo:  " . $item->tipo
                ];
            }
        }

        return response()->json($results);
    }

    public function crear(ReservaHuespedRequest $datos): JsonResponse
    {
        try {
            $this->misReservas->crear($datos);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function detalle(Reserva $id): JsonResponse
    {
        return response()->json($id);
    }

    public function editar(ReservaHuespedRequest $datos, Reserva $id): JsonResponse
    {
        try {
            $this->misReservas->editar($datos, $id);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function cancelar(Reserva $id): JsonResponse
    {
        try {
            $id->estado = 'Cancelada';
            $id->save();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => true]);
        }
    }
}
