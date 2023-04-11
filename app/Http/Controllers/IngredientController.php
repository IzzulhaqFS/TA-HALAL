<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngredientRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function create($product_id)
    {
        return view('ingredient/create', \compact('product_id'));
    }

    public function store(CreateIngredientRequest $request)
    {
        $product = Product::select('id')->findOrFail($request->input('product_id'));
        
        try {
            $ingredient = $product->ingredients()->create([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('product.index')->with('error', 'Bahan gagal disimpan.');
        }

        // To do next
        return redirect()->back()->with('success', 'Bahan berhasil disimpan.');

        // return redirect()->route('ingredient.test', ['ingredient_id' => $ingredient->id])
        //     ->with('success', 'Produk berhasil disimpan.');
    }
}
