<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Service\Admins\HabitacionClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;

class HabitacionEstadoController extends Controller
{
    private $habitacioneClass;

    public function __construct(HabitacionClass $habitacioneClass)
    {
        $this->habitacioneClass = $habitacioneClass;
    }

    public function index(): View
    {
        return view('software.pages.habitacionesEstado');
    }

    public function lista(): JsonResponse
    {
        $user = Auth::user();
        if ($user->hasRole('Administrador')) {
            $datos = $this->habitacioneClass->lista();
        }
        if ($user->hasRole('Moderador')) {
            $datos = $this->habitacioneClass->listaModerador($user->sede_id);
        }
        return datatables()->of($datos)->toJson();
    }
}
