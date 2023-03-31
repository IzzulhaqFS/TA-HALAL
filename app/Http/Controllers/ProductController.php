<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
            
        return view('product/index', \compact($products));
    }

    public function create()
    {
        return view('product/create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        try {
            $user->products()->create([
                'name' => $request->input('name'),
                'supplier' => $request->input('supplier'),
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('product.index')->with('error', 'Unable to create product.');
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }
}
