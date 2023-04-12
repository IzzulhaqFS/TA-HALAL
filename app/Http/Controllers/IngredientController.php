<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function create($product_id)
    {
        $product = Product::select(['id', 'name'])->findOrFail($product_id);

        return view('ingredient/create', \compact('product'));
    }

    public function store(CreateIngredientRequest $request)
    {
        $product = Product::select('id')->findOrFail($request->input('product_id'));
        $request->input('is-positif-list')
            ? $statusHalal = 'Halal'
            : $statusHalal = null;
        
        try {
            $ingredient = $product->ingredients()->create([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'status_halal' => $statusHalal,
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('product.index')->with('error', 'Bahan gagal disimpan.');
        }

        return redirect()->route('ingredient.certificate', ['ingredient_id' => $ingredient->id])
            ->with('success', 'Bahan berhasil disimpan.');
    }

    public function certificateCheck($ingredient_id)
    {
        $ingredient = DB::table('ingredients')
            ->select('ingredients.*', 'products.name as product_name')
            ->leftJoin('products', 'ingredients.product_id', '=', 'products.id')
            ->where('ingredients.id', '=', $ingredient_id)
            ->first();

        return view('ingredient/common/certificate', \compact('ingredient'));
    }
}
