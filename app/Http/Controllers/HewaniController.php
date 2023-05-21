<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessBahanBakuRequest;
use App\Http\Requests\ProcessBtpRequest;
use App\Http\Requests\ProcessKelompokBahanRequest;
use App\Http\Requests\ProcessSembelihRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HewaniController extends Controller
{
    public function getIngredientDetail($ingredient_id)
    {
        return DB::table('ingredients')
            ->select('ingredients.*', 'products.name as product_name')
            ->leftJoin('products', 'ingredients.product_id', '=', 'products.id')
            ->where('ingredients.id', '=', $ingredient_id)
            ->first();
    }

    public function checkUjiLabBabi($ingredient_id)
    {
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/hewani/uji-lab-babi', \compact('ingredient'));
    }
    
    public function processUjiLabBabi(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->input('ingredient_id'));
        $certified = $request->input('is-not-babi-certified');

        if ($certified) {
            $validator = Validator::make($request->all(), [
                'is-not-babi-certified' => 'required|string',
                'coa-number' => 'required|string',
                'parameter' => 'required|string',
                'metode' => 'required|string',
                'hasil-uji-lab' => 'required|string',
                'ingredient_id' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->input('hasil-uji-lab')) {
                $ingredient->update(['status_halal' => 'Haram']);
            } else {
                $ingredient->update(['status_halal' => 'Halal']);
            }

            return response('', 204);
        };

        return redirect()->route('hewani.kelompok-bahan', ['ingredient_id' => $ingredient->id]);
    }

    public function checkKelompokBahan($ingredient_id)
    {
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/hewani/kelompok-bahan', \compact('ingredient'));
    }

    public function processKelompokBahan(ProcessKelompokBahanRequest $request, $ingredient_id)
    {
        $kelompokBahan = $request->input('kelompok-bahan');
        $bahanBakuSembelih = $request->input('bahan-baku-sembelih');
        $bahanBakuNonSembelih = $request->input('bahan-baku-nonsembelih');

        !empty($bahanBakuSembelih)
            ? $bahanBaku = $bahanBakuSembelih
            : $bahanBaku = $bahanBakuNonSembelih;

        if ($kelompokBahan == 'sembelih') {
            if ($bahanBaku == 'darah') {
                return redirect()->route('hewani.kehalalan-bahan', 
                    ['ingredient_id' => $ingredient_id, 'bahanBaku' => $bahanBaku, 'statusBahanBaku' => 'Haram']);        
            }

            return redirect()->route('hewani.bahan-baku', 
                ['ingredient_id' => $ingredient_id, 'bahanBaku' => $bahanBaku]);
        } else {
            return redirect()->route('hewani.kehalalan-bahan', 
                ['ingredient_id' => $ingredient_id, 'bahanBaku' => $bahanBaku, 'statusBahanBaku' => 'Halal']);
        }
    }

    public function checkBahanBaku(Request $request, $ingredient_id)
    {
        $ingredient =  $this->getIngredientDetail($ingredient_id);
        $bahanBaku = $request->query('bahanBaku');

        if (empty($bahanBaku)) {
            $product_id = $ingredient->product->id;

            return redirect()->route('product.show', ['product_id' => $product_id])
                ->with('error', 'Bahan baku tidak berhasil diproses.');
        }
        
        return view('ingredient/hewani/'. $bahanBaku, \compact('ingredient', 'bahanBaku'));
    }

    public function processBahanBaku(ProcessBahanBakuRequest $request, $ingredient_id)
    {
        $bahanBaku = $request->input('bahanBaku');
        $statusBahanBaku = $request->input('kehalalan-bahan');
        
        return redirect()->route('hewani.kehalalan-bahan', 
                ['ingredient_id' => $ingredient_id, 'bahanBaku' => $bahanBaku, 'statusBahanBaku' => $statusBahanBaku]);
    }
    
    public function checkKehalalanBahan(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahanBaku');
        $statusBahanBaku = $request->query('statusBahanBaku');
        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/kehalalan-bahan', \compact('ingredient', 'bahanBaku', 'statusBahanBaku'));   
    }

    public function processKehalalanBahan(Request $request, $ingredient_id)
    {
        $ingredient = Ingredient::findOrFail(($ingredient_id));
        $statusBahanBaku = $request->input('kehalalan-bahan');

        if ($statusBahanBaku == 'Haram') {
            $ingredient->update(['status_halal' => 'Haram']);
            return response('', 204);
        };

        return redirect()->route('hewani.sembelih', ['ingredient_id' => $ingredient_id]);

    }

    public function checkSembelih(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahanBaku');
        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/sembelih', \compact('ingredient', 'bahanBaku'));   
    }

    public function processSembelih(ProcessSembelihRequest $request, $ingredient_id){
        $ingredient = Ingredient::findOrFail(($ingredient_id));
        $statusBahanBaku = $request->input('kehalalan-bahan');

        if ($statusBahanBaku == 'Haram') {
            $ingredient->update(['status_halal' => 'Haram']);
            return response('', 204);
        };

        return redirect()->route('hewani.pengolahan-tambahan', ['ingredient_id' => $ingredient_id]);
    }

    public function checkPengolahanTambahan(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahanBaku');
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/hewani/pengolahan-tambahan', \compact('ingredient', 'bahanBaku')); 
    }

    public function processPengolahanTambahan(ProcessBtpRequest $request, $ingredient_id)
    {
        $listBTP = $request->input('list-btp');
        $bahanBaku = $request->input('bahanBaku');
        
        return redirect()->route('hewani.btp', 
            ['ingredient_id' => $ingredient_id, 'bahanBaku' => $bahanBaku, 'list-btp' => $listBTP]);
    }

    public function checkBTP(Request $request, $ingredient_id)
    {
        $listBTP = $request->query('list-btp');
        $loweredBTP = strtolower($listBTP);
        $slugifiedBTP = str_replace(' ', '-', $loweredBTP);
        $arrayBTP = explode(',', $slugifiedBTP);
        
        $bahanBaku = $request->query('bahanBaku');

        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/btp', \compact('ingredient', 'bahanBaku', 'arrayBTP')); 
        
    }
}
