<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservaRequest;
use App\Models\Reserva;
use App\Service\Admins\ReservaClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class ReservaController extends Controller
{
    private $reservaClass;

    public function __construct(ReservaClass $reservaClass)
    {
        $this->reservaClass = $reservaClass;
    }

    public function index(): View
    {
        return view('software.pages.reservas');
    }

    public function lista()
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            $datos = $this->reservaClass->listaAdmin();
        }
        if ($user->hasRole('Moderador')) {
            $datos = $this->reservaClass->listaModerador($user->sede_id);
        }
        return datatables()->of($datos)->toJson();
    }

    public function huesped(Request $request): JsonResponse
    {
        $huesped = $this->reservaClass->huesped();

        $term = $request->get('term');

        $results = [];

        foreach ($huesped as $item) {
            if (stristr($item->name, $term)) {
                $results[] = [
                    'huespedId' => $item->id,
                    'huespedText' => $item->identificacion
                ];
            }
        }

        return response()->json($results);
    }

    public function habitaciones(Request $request): JsonResponse
    {
        $habitaciones = $this->reservaClass->habitaciones();

        $term = $request->get('term');

        $results = [];

        foreach ($habitaciones as $item) {
            if (stristr($item->identificador, $term)) {
                $results[] = [
                    'habitacionId' => $item->id,
                    'habitacionText' => $item->identificador
                ];
            }
        }

        return response()->json($results);
    }

    public function crear(ReservaRequest $datos): JsonResponse
    {
        try {
            // Buscar si tiene una reserva en proceso
            $dato = $this->reservaClass->verificarActiva($datos['huesped_id']);
            if ($dato == 'verdadero') {
                return response()->json(['error' => true]);
            }
            $this->reservaClass->crear($datos);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true]);
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

    public function activar(Reserva $id): JsonResponse
    {
        $id->estado = 'Activa';
        $id->save();
        $this->reservaClass->Ocupar($id->habitacione_id);
        return response()->json(['success' => true]);
    }

    public function completada(Reserva $id): JsonResponse
    {
        $id->estado = 'Completada';
        $id->save();
        $this->reservaClass->habitacionLibre($id->habitacione_id);
        return response()->json(['success' => true]);
    }
}
