<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\Admins\AdminsClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdministradoreController extends Controller
{
    private $administradorClass;

    public function __construct(AdminsClass $administradorClass)
    {
        $this->administradorClass = $administradorClass;
    }

    public function index(): View
    {
        return view('software.pages.administradores');
    }

    public function lista()
    {
        $datos = $this->administradorClass->lista();
        return datatables()->of($datos)->toJson();
    }

    public function crear(UserRequest $datos): JsonResponse
    {
        try {
            $this->administradorClass->crear($datos);
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
            $this->administradorClass->editar($datos, $id);
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
