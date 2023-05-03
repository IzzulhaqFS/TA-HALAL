<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use App\Models\EventLog;
use App\Models\SubActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    public function store(ActivityStoreRequest $request) {
        $mainActivity = $request->input('main-activity');
        $subActivity = $request->input('sub-activity');

        return redirect()->route('product.index')->with('success', 'Pengecekan bahan selesai.');
    }
}
