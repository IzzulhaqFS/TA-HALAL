<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessBahanBakuRequest;
use App\Http\Requests\ProcessBtpRequest;
use App\Http\Requests\ProcessTipeBahanHewaniRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
    public function checkKelompokBahan($ingredient_id)
    {
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/hewani/kelompok-bahan', \compact('ingredient'));
    }

    public function processKelompokBahan(ProcessTipeBahanHewaniRequest $request, $ingredient_id)
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
                    ['ingredient_id' => $ingredient_id, 'bahan-baku' => $bahanBaku, 'status-bahan-baku' => 'Haram']);        
            }

            return redirect()->route('hewani.bahan-baku', 
                ['ingredient_id' => $ingredient_id, 'bahan-baku' => $bahanBaku]);
        } 

        if ($kelompokBahan == 'nonsembelih') {
            return redirect()->route('hewani.kehalalan-bahan', 
                ['ingredient_id' => $ingredient_id, 'bahan-baku' => $bahanBaku, 
                    'status-bahan-baku' => 'Halal', 'nonsembelih' => true]);
        }
    }

    public function checkBahanBaku(Request $request, $ingredient_id)
    {
        $ingredient =  $this->getIngredientDetail($ingredient_id);
        $bahanBaku = $request->query('bahan-baku');

        if (empty($bahanBaku)) {
            $product_id = $ingredient->product->id;

            return redirect()->route('product.show', ['product_id' => $product_id])
                ->with('error', 'Bahan baku tidak berhasil diproses.');
        }
        
        return view('ingredient/hewani/'. $bahanBaku, \compact('ingredient', 'bahanBaku'));
    }

    public function processBahanBaku(ProcessBahanBakuRequest $request, $ingredient_id)
    {
        $bahanBaku = $request->input('bahan-baku');
        $statusBahanBaku = $request->input('kehalalan-bahan');
        
        return redirect()->route('hewani.kehalalan-bahan', 
                ['ingredient_id' => $ingredient_id, 'bahan-baku' => $bahanBaku, 'status-bahan-baku' => $statusBahanBaku]);
    }
    
    public function checkKehalalanBahan(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahan-baku');
        $statusBahanBaku = $request->query('status-bahan-baku');
        $kelompokBahan = empty($request->query('nonsembelih')) ? 'sembelih' : 'nonsembelih';
        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/kehalalan-bahan', \compact('ingredient', 'bahanBaku', 'statusBahanBaku', 'kelompokBahan'));   
    }

    public function processKehalalanBahan(Request $request, $ingredient_id)
    {
        $ingredient = Ingredient::findOrFail(($ingredient_id));
        $bahanBaku = $request->query('bahan-baku');
        $kelompokBahan = $request->query('kelompok-bahan');
        
        if ($kelompokBahan == 'sembelih') {
            return redirect()->route('hewani.sembelih', ['ingredient_id' => $ingredient->id, 'bahan-baku' => $bahanBaku]);
        }
            
        if ($kelompokBahan == 'nonsembelih') {
            return redirect()->route('hewani.pengolahan-tambahan', ['ingredient_id' => $ingredient->id, 'bahan-baku' => $bahanBaku]);
        }
    }

    public function checkSembelih(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahan-baku');
        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/sembelih', \compact('ingredient', 'bahanBaku'));   
    }

    public function checkPengolahanTambahan(Request $request, $ingredient_id)
    {
        $bahanBaku = $request->query('bahan-baku');
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/hewani/pengolahan-tambahan', \compact('ingredient', 'bahanBaku')); 
    }

    public function processPengolahanTambahan(ProcessBtpRequest $request, $ingredient_id)
    {
        $listBTP = $request->input('list-btp');
        $bahanBaku = $request->input('bahan-baku');
        
        return redirect()->route('hewani.btp', 
            ['ingredient_id' => $ingredient_id, 'bahan-baku' => $bahanBaku, 'list-btp' => $listBTP]);
    }

    public function checkBTP(Request $request, $ingredient_id)
    {
        $listBTP = $request->query('list-btp');
        $loweredBTP = strtolower($listBTP);
        $slugifiedBTP = str_replace(' ', '-', $loweredBTP);
        $arrayBTP = explode(',', $slugifiedBTP);
        
        $bahanBaku = $request->query('bahan-baku');

        $ingredient = $this->getIngredientDetail($ingredient_id);
        
        return view('ingredient/hewani/btp', \compact('ingredient', 'bahanBaku', 'arrayBTP')); 
    }
}