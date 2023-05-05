<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\EventLog;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\SubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\UuidGenerator;

class ActivityController extends Controller
{
    public function store(StoreActivityRequest $request) {        

        // Clean data with duplicate label. Result type is Collection
        $mainActivity = $this->cleanData($request->input('main-activity'));
        $subActivity = $this->cleanData($request->input('sub-activity'));

        $cleanedData = [
            'event-log' => $mainActivity,
            'sub-activity' => $subActivity,
            'message' => 'Data successfully retrieved',
        ];

        // Init identity variables
        $identity = ['ingredientId' => null, 'productId' => null, 'userId' => null];

        // Check ingredientId
        $hasIngredientId = $subActivity->contains(function ($value, $key) {
            return $value['label'] === 'ingredient_id';
        });

        Log::debug('LATEST INGREDIENT_ID:', ['id' => Ingredient::getLatest(), 'count' => Ingredient::count()]);
        // Fill data identity
        (!$hasIngredientId)
            ? $identity['ingredientId'] = Ingredient::getLatest()
            : $identity['ingredientId'] = $subActivity->where('label', 'ingredient_id')->pluck('value')->first();
        $identity['productId'] = $subActivity->where('label', 'product_id')->pluck('value')->first();
        $identity['userId'] = Product::findOrFail($identity['productId'])->user->id;
        
        $this->storeEventlog($mainActivity, $identity);
        $this->storeSubActivity($subActivity);
        
        return response()->json($cleanedData, 200);
    }

    public function cleanData($data) {
        return collect($data)->reduce(function($result, $item) {
            $label = $item['label'];
            $id = $item['id'];
            $value = $item['value'];
            $timestamp = isset($item['timestamp']) ? $item['timestamp'] : null;
    
            // Check if an item with the same "label" key already exists
            $existingItemIndex = $result->search(function($existingItem) use ($label) {
                return $existingItem['label'] === $label;
            });
    
            if ($existingItemIndex !== false) {
                $existingItem = $result->get($existingItemIndex);
                $existingItem['id'] = $id;
                $existingItem['value'] = $value;
                if (!is_null($timestamp)) {
                    $existingItem['timestamp'] = $timestamp;
                }
                
                // Updates existing item in the collection at the specified index 
                $result->put($existingItemIndex, $existingItem);
            } else {
                $newItem = [
                    'id' => $id,
                    'label' => $label,
                    'value' => $value
                ];
                if (!is_null($timestamp)) {
                    $newItem['timestamp'] = $timestamp;
                }

                // Appends an item to the end of the collection
                $result->push($newItem);
            }
    
            return $result;
        }, collect());
    }

    public function storeEventlog ($mainActivity, $identity) {
        $data = $mainActivity->map(function ($item) use ($identity) {
            return [
                'id' => $item['id'],
                'activity' => $item['label'],
                'status_halal' => $item['value'],
                'timestamp' => $item['timestamp'],
                'user_id' => $identity['userId'],
                'product_id' => $identity['productId'],
                'ingredient_id' => $identity['ingredientId'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        })->toArray();    
        
        Log::debug('main data:', $data);

        try {
            EventLog::insert($data);
        } catch (\Exception $e) {
            Log::error('Error creating event log: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating event log'], 500);
        }
    }

    public function storeSubActivity($subActivity) {
        $data = $subActivity->map(function ($item) {
            return [
                'id' => UuidGenerator::get(),
                'description' => $item['label'],
                'value' => $item['value'],
                'event_log_id' => $item['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        })->toArray();

        Log::debug('sub data:', $data);
        
        try {
            SubActivity::insert($data);
        } catch (\Exception $e) {
            Log::error('Error creating sub activity: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating sub activity'], 500);
        }
    }
}
