<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use App\Models\EventLog;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\SubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    public function store(ActivityStoreRequest $request) {        
        return response()->json('masukk', 200);

        
        // log the request data
        Log::debug('Incoming request data:', $request->all());

        // Convert input to Collection 
        $mainActivity = \collect($request->input('main-activity'));
        $subActivity = \collect($request->input('sub-activity'));

        // Init identity vars
        $ingredientId = $productId = $userId = null;

        // Check ingredientId
        $hasIngredientId = $subActivity->contains(function ($value, $key) {
            return $value['label'] === 'ingredient_id';
        });
        
        // Fill data identity
        (!$hasIngredientId)
            ? $ingredientId = Ingredient::getLatest()
            : $ingredientId = $subActivity->where('label', 'ingredient_id')->pluck('value')->first();
        $productId = $subActivity->where('label', 'product_id')->pluck('value')->first();
        $userId = Product::findOrFail($productId)->user()?->id;

        // Init Data
        $mainActivityData = $subActivityData = [];

        // Build Eventlog data
        foreach ($mainActivity as $item) {
            $data = [
                'id' => $item->id,
                'activity' => $item->label,
                'status_halal' => $item->value,
                'timestamp' => $item->timestamp,
                'user_id' => $userId,
                'product_id' => $productId,
                'ingredient_id' => $ingredientId,
            ];
            
            \array_merge($mainActivityData, $data);
        }

        // Insert Eventlog data
        EventLog::createMany($data);

        // Build SubActivity data
        foreach ($subActivity as $item) {
            $data = [
                'description' => $item->label,
                'status_halal' => $item->value,
                'event_log_id' => $item->id,
            ];
            
            \array_merge($subActivityData, $data);
        };
        
        // Insert Eventlog data
        SubActivity::createMany($data);
        

        return redirect()->route('product.index')->with('success', 'Pengecekan bahan selesai.');
    }
}
