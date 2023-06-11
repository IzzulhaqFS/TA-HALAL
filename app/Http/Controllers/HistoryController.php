<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::whereNotNull('status_halal')
            ->withWhereHas('product', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('history/index', \compact('ingredients'));
    }
}
