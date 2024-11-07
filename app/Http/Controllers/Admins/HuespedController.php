<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\Admins\HuespedClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HuespedController extends Controller
{
    private $huespedClass;

    public function __construct(HuespedClass $huespedClass)
    {
        $this->huespedClass = $huespedClass;
    }

    public function index(): View
    {
        return view('software.pages.huesped');
    }

    public function lista()
    {
        $datos = $this->huespedClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function crear(UserRequest $datos): JsonResponse
    {
        try {
            $this->huespedClass->crear($datos);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function detalle(user $id): JsonResponse
    {
        return response()->json($id);
    }

    public function editar(UserRequest $datos, User $id): JsonResponse
    {
        try {
            $this->huespedClass->editar($datos, $id);
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function eliminar(User $id): JsonResponse
    {
        $id->delete();
        return response()->json(['success' => true]);
    }
}
