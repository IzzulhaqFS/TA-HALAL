<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreeningProdukJadi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScreeningProdukJadiController extends Controller
{
    public function index()
    {
        $products = DB::table('screening_produk_jadi as j')
            ->select(
                'j.id', 'j.user_id', 'j.nama_produk', 'j.daftar_bahan', 'j.halal'
            )
            ->where('j.user_id', '=', Auth::user()->id)
            ->groupBy('j.id', 'j.user_id', 'j.nama_produk', 'j.daftar_bahan', 'j.halal')
            ->paginate(10);

        return view('screening/history-produk-jadi', \compact('products'));
    }

    public function create()
    {
        return view('screening/create-produk-jadi');
    }

    public function store(Request $request) 
    {
        $user = Auth::user();
        $namaProduk = $request->input('nama-produk');
        $daftarBahan = $request->input('nama-bahan');
        $bahanPenolong = $request->has('bahan-penolong') ? true : false;

        $isHalal = 'Halal';
        
        try {  
            $ScreeningProdukJadi = $user->screeningProdukJadi()->create([
                'nama_produk' => $namaProduk,
                'daftar_bahan' => $daftarBahan,
                'bahan_penolong' => $bahanPenolong,
                'halal' => $isHalal,
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('screening.produk-jadi')->with('error', 'Produk gagal disimpan.');
        }

        return view('screening/create-produk-jadi', \compact('namaProduk', 'daftarBahan', 'isHalal'));
    }

    public function destroy($screening_produk_jadi_id)
    {
        $deleted = ScreeningProdukJadi::findOrFail($screening_produk_jadi_id)->delete();

        if ($deleted) {
            return redirect()->route('screening.history-product-jadi')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus.');

        }
    }
}
