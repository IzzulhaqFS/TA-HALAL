<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function createHewani()
    {
        return view('screening/create');
    }
}
