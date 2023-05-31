<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function tes() {
        return view('product/tes');
    }
    public function index()
    {
        /* EXPLANATION:
            - If all related ingredients have status_halal of 'halal', 
                then the product_status will be 'halal'.
            - If at least one related ingredient has a status_halal of 'haram', 
                then the product_status will be 'haram'.
            - If there are no related ingredients with status_halal of 'halal' 
                and no related ingredients with status_halal of 'haram', 
                then the product_status will be 'syubhat'. 
        */

        $products = DB::table('products as p')
            ->select(
                'p.*', 
                DB::raw('COUNT(i.id) AS ingredient_count'),
                DB::raw("CASE
                            WHEN COUNT(CASE WHEN i.status_halal = 'Haram' THEN 1 END) > 0 THEN 'Haram'
                            WHEN COUNT(CASE WHEN i.status_halal IS NULL THEN 1 END) > 0 THEN 'Dalam Proses'
                            WHEN COUNT(CASE WHEN i.status_halal = 'Syubhat' THEN 1 END) > 0 THEN 'Syubhat'
                            ELSE 'Halal'
                        END AS product_status")
            )
            ->leftJoin('ingredients as i', 'p.id', '=', 'i.product_id')
            ->groupBy('p.id')
            ->paginate(10);

        return view('product/index', \compact('products'));
    }

    public function create()
    {
        return view('product/create');
    }

    public function store(CreateProductRequest $request)
    {
        $user = Auth::user();
        
        try {
            $product = $user->products()->create([
                'name' => $request->input('nama-produk'),
                'supplier' => $request->input('supplier'),
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('product.index')->with('error', 'Produk gagal disimpan.');
        }

        return redirect()->route('ingredient.create', ['product_id' => $product->id])
            ->with('success', 'Produk berhasil disimpan.');
    }

    public function show($product_id)
    {
        $ingredients = Ingredient::where('product_id', $product_id)->paginate(10);
        $product = Product::select(['id', 'name'])->findOrFail($product_id);

        return view('product/show', \compact('ingredients', 'product'));
    }

    public function destroy($product_id)
    {
        $deleted = Product::findOrFail($product_id)->delete();

        if ($deleted) {
            return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus.');

        }
    }
}
