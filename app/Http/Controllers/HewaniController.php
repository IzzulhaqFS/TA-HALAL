<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUjiBabiRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HewaniController extends Controller
{
    public function checkUjiLabBabi($ingredient_id)
    {
        $ingredient = DB::table('ingredients')
            ->select('ingredients.*', 'products.name as product_name')
            ->leftJoin('products', 'ingredients.product_id', '=', 'products.id')
            ->where('ingredients.id', '=', $ingredient_id)
            ->first();

        return view('ingredient/hewani/uji-lab-babi', \compact('ingredient'));
    }
    
    public function storeUjiLabBabi(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->input('ingredient_id'));
        $certified = $request->input('is-not-babi-certified');

        if ($certified) {
            $validator = Validator::make($request->all(), [
                'is-not-babi-certified' => 'required',
                'coa-number' => 'required',
                'parameter' => 'required',
                'metode' => 'required',
                'hasil-uji-lab' => 'required',
                'ingredient_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->input('hasil-uji-lab')) {
                $ingredient->update(['status_halal' => "Haram"]);
            } else {
                $ingredient->update(['status_halal' => "Halal"]);
            }

            return response('', 204);
        };

        return response('aman', 200);
        // return redirect()->route('hewani.kelompok-bahan', ['ingredient_id' => $ingredient->id]);
        
    }
}
