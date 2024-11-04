<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\Admins\ModeradorClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModeradoreController extends Controller
{
    private $moderadorClass;

    public function __construct(ModeradorClass $moderadorClass)
    {
        $this->moderadorClass = $moderadorClass;
    }

    public function index(): View
    {
        return view('software.pages.moderadores');
    }

    public function lista()
    {
        $datos = $this->moderadorClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function sedes(Request $request): JsonResponse
    {
        $sedes = $this->moderadorClass->sedes();

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

    public function crear(UserRequest $datos): JsonResponse
    {
        try {
            $this->moderadorClass->crear($datos);
            $repuesta = response()->json(['success' => true], 201);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false], 400);
        }
        return $repuesta;
    }

    public function detalle(User $id): JsonResponse
    {
        // $datos = $this->moderadorClass->detalle($id);
        return response()->json($id);
    }

    public function editar(UserRequest $datos, User $id): JsonResponse
    {
        try {
            $this->moderadorClass->editar($datos, $id);
            $repuesta = response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false], 400);
        }
        return $repuesta;
    }

    public function eliminar(User $id): JsonResponse
    {
        $id->delete();
        return response()->json(['success' => true]);
    }
}
