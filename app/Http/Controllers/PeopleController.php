<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\People;

class PeopleController extends Controller
  {
   public function guru() {
    $guru = People::where('tipe', 'guru')
                  ->orderBy('nomor_induk', 'desc')
                  ->get();

    return Inertia::render('People/Guru', [
        'guru' => $guru
    ]);
}

public function staff() {
    $staff = People::where('tipe', 'staf')
                   ->orderBy('nomor_induk', 'desc')
                   ->get();

    return Inertia::render('People/Staff', [
        'staff' => $staff
    ]);
}

}
