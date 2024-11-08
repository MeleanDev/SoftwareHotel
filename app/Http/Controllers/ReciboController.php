<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReciboController extends Controller
{
    public function index(): view
    {
        return view('software.pages.recibos');
    }

    public function lista(){
        
    }
}
