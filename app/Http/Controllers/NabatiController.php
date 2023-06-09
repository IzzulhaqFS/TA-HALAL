<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessTipeBahanNabatiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\KelompokNabati;
use App\Http\Requests\processBahanKritisRequest;

class NabatiController extends Controller
{
    public function getIngredientDetail($ingredient_id)
    {
        return DB::table('ingredients')
            ->select('ingredients.*', 'products.name as product_name')
            ->leftJoin('products', 'ingredients.product_id', '=', 'products.id')
            ->where('ingredients.id', '=', $ingredient_id)
            ->first();
    }

    public function checkUjiLabBabiEtanol($ingredient_id)
    {
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/nabati/uji-lab-babi-etanol', \compact('ingredient'));
    }

    public function checkKelompokBahan($ingredient_id)
    {
        $ingredient = $this->getIngredientDetail($ingredient_id);

        return view('ingredient/nabati/kelompok-bahan', \compact('ingredient'));
    }

    public function processKelompokBahan(ProcessTipeBahanNabatiRequest $request, $ingredient_id)
    {
        $kelompokBahan = $request->input('kelompok-bahan');
        $titikKritis = KelompokNabati::get($kelompokBahan);

        return redirect()->route('nabati.potensi-bahan-kritis', 
            ['ingredient_id' => $ingredient_id, 'kelompok-bahan' => $kelompokBahan, 'titik-kritis' => $titikKritis]);
    }

    public function checkPotensiBahanKritis(Request $request, $ingredient_id)
    {
        $ingredient =  $this->getIngredientDetail($ingredient_id);
        $kelompokBahan = $request->query('kelompok-bahan');
        $titikKritis = $request->query('titik-kritis');

        if (empty($kelompokBahan)) {
            $product_id = $ingredient->product->id;

            return redirect()->route('product.show', ['product_id' => $product_id])
                ->with('error', 'Bahan baku tidak berhasil diproses.');
        }
        
        return view('ingredient/nabati/potensi-bahan-kritis', \compact('ingredient', 'kelompokBahan', 'titikKritis'));
    }

    public function processPotensiBahanKritis(processBahanKritisRequest $request, $ingredient_id)
    {
        $kelompokBahan = $request->input('kelompok-bahan');
        $bahanKritis = $request->input('bahan-kritis');

        return redirect()->route('nabati.titik-kritis', 
            ['ingredient_id' => $ingredient_id, 'kelompok-bahan' => $kelompokBahan, 'bahan-kritis' => $bahanKritis, 'index' => 0]);
    }

    public function checkTitikKritis(Request $request, $ingredient_id)
    {
        $ingredient =  $this->getIngredientDetail($ingredient_id);
        $index = (int) $request->query('index');
        $kelompokBahan = $request->query('kelompok-bahan');
        $listBahanKritis = $request->query('bahan-kritis');
        $titikKritis = explode(",", $listBahanKritis);

        return view('ingredient/nabati/'. $titikKritis[$index], \compact('ingredient', 'kelompokBahan', 'listBahanKritis', 'index'));
    }
}
