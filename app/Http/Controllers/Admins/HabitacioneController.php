<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\HabitacioneRequest;
use App\Models\Habitacione;
use App\Service\Admins\HabitacionClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitacioneController extends Controller
{
    private $habitacioneClass;

    public function __construct(HabitacionClass $habitacioneClass)
    {
        $this->habitacioneClass = $habitacioneClass;
    }

    public function index(): View
    {
        return view('software.pages.habitaciones');
    }

    public function lista(): JsonResponse
    {
        $datos = $this->habitacioneClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function listaSedes(Request $request): JsonResponse
    {
        $sedes = $this->habitacioneClass->sedes();

        $term = $request->get('term');

        $results = [];

        foreach ($sedes as $item) {
            if (stristr($item->nombre, $term)) {
                $results[] = [
                    'sedeId' => $item->id,
                    'sedeText' => $item->nombre
                ];
            }
        }

        return response()->json($results);
    }

    public function detalle($id): JsonResponse
    {
        $datos = Habitacione::with('sede')->find($id);
        return response()->json($datos);
    }

    public function crear(HabitacioneRequest $datos): JsonResponse
    {
        try {
            $this->habitacioneClass->crear($datos);
            $repuesta = response()->json(['success' => true], 201);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false], 400);
        }
        return $repuesta;
    }

    public function editar(HabitacioneRequest $datos, Habitacione $id)
    {
        try {
            $this->habitacioneClass->editar($datos, $id);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Datos de la habitacion editados con exito'
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => false,
                'msj' => 'Error en la Modificacion'
            ], 400);
        }
        return $repuesta;
    }

    public function eliminar(Habitacione $id): JsonResponse
    {
        $id->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
