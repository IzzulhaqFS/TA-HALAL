<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $request->input('is-positive-list')
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

        if ($statusHalal == 'Halal') {
            return response('', 204);
        }

        return redirect()->route('ingredient.certificate', ['ingredient_id' => $ingredient->id])
            ->with('success', 'Bahan berhasil disimpan.');
    }

    public function checkCertificate($ingredient_id)
    {
        $ingredient = DB::table('ingredients')
            ->select('ingredients.*', 'products.name as product_name')
            ->leftJoin('products', 'ingredients.product_id', '=', 'products.id')
            ->where('ingredients.id', '=', $ingredient_id)
            ->first();

        return view('ingredient/common/certificate', \compact('ingredient'));
    }
    
    public function storeCertificate(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->input('ingredient_id'));
        $halal = $request->input('is-halal-certified');
        
        if ($halal) {
            // Validate the request if is-halal-certified is truthy
            $validator = Validator::make($request->all(), [
                'is-halal-certified' => 'required',
                'certificate-number' => 'required',
                'certificate-institution' => 'required',
                'certificate-start-date' => 'required',
                'certificate-end-date' => 'required',
                'ingredient_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        $ingredient->update(['status_halal' => "Halal"]);
        return response('', 204);
    }
    
    if ($ingredient->type == 'Hewani') {
        return redirect()->route('hewani.uji-lab-babi', ['ingredient_id' => $ingredient->id]);
    } else {
        return redirect()->route('nabati.uji-lab-babi', ['ingredient_id' => $ingredient->id]);
    }    
}

    
    public function show($ingredient_id)
    {

    }

    public function destroy($ingredient_id)
    {   
        $ingredient = Ingredient::findOrFail($ingredient_id);
        $product_id = $ingredient->product->id;
        $deleted = $ingredient->delete();

        if ($deleted) {
            return redirect()->route('product.show', ['product_id' => $product_id])->with('success', 'Bahan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Bahan gagal dihapus.');
        }
    }
}
