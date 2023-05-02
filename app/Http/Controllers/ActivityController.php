<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    public function store(ActivityStoreRequest $request) {
        \dd($request);
        
        return redirect()->route('product.index')->with('success', 'Pengecekan bahan selesai.');
    }
}
