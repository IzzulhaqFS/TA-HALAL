<?php

namespace App\Http\Controllers;

use App\Models\EventLog;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $productCount = Product::where('user_id', $user?->id)
            ->selectRaw('COUNT(products.id) as product_count')
            ->value('product_count');

        // Ingredient Related
        $ingredient = Product::where('user_id', $user?->id)
            ->join('ingredients', 'products.id', '=', 'ingredients.product_id')
            ->get();

        $ingredientCount = $ingredient->count();
        $doneIngredientCount = $ingredient->where('status_halal', '<>', null)->count();
        $inProcessIngredientCount = $ingredient->where('status_halal', '=', null)->count();
        $halalIngredientCount = $ingredient->where('status_halal', '=', 'Halal')->count();
        $haramIngredientCount = $ingredient->where('status_halal', '=', 'Haram')->count();
        $syubhatIngredientCount = $ingredient->where('status_halal', '=', 'Syubhat')->count();

        $halalPercentage = $haramPercentage = $syubhatPercentage = 0;
        if ($ingredientCount) {
            $halalPercentage = (int) round(($halalIngredientCount / $doneIngredientCount) * 100);
            $haramPercentage = (int) round(($haramIngredientCount / $doneIngredientCount) * 100);
            $syubhatPercentage = (int) round(($syubhatIngredientCount / $doneIngredientCount) * 100);
        }

        // Activity Related
        $eventLogs = EventLog::where('user_id', $user?->id)->get();
        $eventLogCount = $eventLogs->count();
        $halalActivity = $eventLogs->where('status_halal', 'Halal')->count();
        $haramActivity = $eventLogs->where('status_halal', 'Haram')->count();
        $syubhatActivity = $eventLogs->where('status_halal', 'Syubhat')->count();
        
        $data = [
            'productCount' => $productCount,
            'ingredientCount' => $ingredientCount,
            'doneIngredientCount' => $doneIngredientCount,
            'inProcessIngredientCount' => $inProcessIngredientCount,
            'halalIngredientCount' => $halalIngredientCount,
            'haramIngredientCount' => $haramIngredientCount,
            'syubhatIngredientCount' => $syubhatIngredientCount,
            'halalPercentage' => $halalPercentage,
            'haramPercentage' => $haramPercentage,
            'syubhatPercentage' => $syubhatPercentage,
            'eventLogCount' => $eventLogCount,
            'halalActivity' => $halalActivity,
            'haramActivity' => $haramActivity,
            'syubhatActivity' => $syubhatActivity,
        ];

        return view('home/index', compact('data'));
    }
}
