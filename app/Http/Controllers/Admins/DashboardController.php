<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Service\Admins\DashboardClass;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private $dashboardClass;

    public function __construct(DashboardClass $dashboardClass)
    {
        $this->dashboardClass = $dashboardClass;
    }

    public function index(): View
    {
        $habitaciones = $this->dashboardClass->habitaciones();
        $reservas = $this->dashboardClass->reservas();
        $huespedes = $this->dashboardClass->huesped();
    
        return view('dashboard', compact('huespedes', 'reservas', 'habitaciones'));
    }

    public function manual()
    {
        $filePath = public_path('manual/pdf/ManualdeUsuario.pdf');

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="ManualdeUsuario.pdf"'
        ]);
    }
}
