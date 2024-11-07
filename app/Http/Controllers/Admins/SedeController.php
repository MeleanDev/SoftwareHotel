<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SedeRequest;
use App\Models\Sede;
use App\Service\Admins\SedeClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class SedeController extends Controller
{
    private $sedeClass;

    public function __construct(SedeClass $sedeClass)
    {
        $this->sedeClass = $sedeClass;
    }

    public function index(): View
    {
        return view('software.pages.sedes');
    }

    public function lista()
    {
        $datos = $this->sedeClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function crear(SedeRequest $datos): JsonResponse
    {
        try {
            $this->sedeClass->crear($datos);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function detalle($id): JsonResponse
    {
        $datos = $this->sedeClass->detalle($id);
        return response()->json($datos);
    }

    public function editar(SedeRequest $datos, Sede $id): JsonResponse
    {
        try {
            $this->sedeClass->editar($datos, $id);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function eliminar(Sede $id): JsonResponse
    {
        $id->delete();
        return response()->json(['success' => true]);
    }

}
