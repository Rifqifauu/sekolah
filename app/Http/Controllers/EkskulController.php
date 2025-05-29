<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EkskulController extends Controller
{
    public function index(){
       $ekstrakurikuler = Ekstrakurikuler::orderBy('created_at', 'desc')->get();
        return Inertia::render('Ekstrakurikuler/Index', [
            'ekstrakurikuler' => $ekstrakurikuler
        ]);  
    }
}
