<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
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

        $products = DB::select("
            SELECT 
                p.*, 
                COUNT(i.id) AS ingredient_count,
                CASE
                    WHEN COUNT(CASE WHEN i.status_halal = 'haram' THEN 1 END) > 0 THEN 'Haram'
                    WHEN COUNT(CASE WHEN i.status_halal IS NULL THEN 1 END) > 0 THEN 'Belum Dicek'
                    WHEN COUNT(CASE WHEN i.status_halal = 'syubhat' THEN 1 END) > 0 THEN 'Syubhat'
                    ELSE 'Halal'
                END AS product_status
            FROM 
                products p
                LEFT JOIN ingredients i ON p.id = i.product_id
            GROUP BY 
                p.id
        ");
            
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
                'name' => $request->input('name'),
                'supplier' => $request->input('supplier'),
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('product.index')->with('error', 'Produk gagal disimpan.');
        }

        return redirect()->route('ingredient.create', ['product_id' => $product->id])
            ->with('success', 'Produk berhasil disimpan.');
    }
}
