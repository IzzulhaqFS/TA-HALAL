<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreeningProdukHewani;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScreeningProdukHewaniController extends Controller
{
    public function index()
    {
        $products = DB::table('screening_hewani as h')
            ->select(
                'h.id', 'h.user_id', 'h.nama_produk', 'h.jenis_bahan', 'h.nama_hewan', 'h.halal'
            )
            ->where('h.user_id', '=', Auth::user()->id)
            ->groupBy('h.id', 'h.user_id', 'h.nama_produk', 'h.jenis_bahan', 'h.nama_hewan', 'h.halal')
            ->paginate(10);

        return view('screening/history-hewani', \compact('products'));
    }

    public function create()
    {
        return view('screening/create-hewani');
    }

    public function store(Request $request) 
    {
        $user = Auth::user();
        $namaProduk = $request->input('nama-produk');
        $jenisBahan = $request->input('jenis-bahan');
        $namaHewan = $request->input('nama-hewan');
        $hewanHalal = $request->has('hewan-halal') ? true : false;
        $sembelihSyariat = $request->has('sembelih-syariat') ? true : false;
        $pengolahanLanjutan = $request->has('pengolahan-lanjutan') ? true : false;
        
        $isHalal = '';

        if (($jenisBahan == 'Telur' || $jenisBahan == 'Susu' || $jenisBahan == 'Madu' || $jenisBahan == 'Ikan') && !$pengolahanLanjutan) {
            $isHalal = 'Halal';
        } elseif (($jenisBahan == 'Telur' || $jenisBahan == 'Susu' || $jenisBahan == 'Madu' || $jenisBahan == 'Ikan') && $pengolahanLanjutan) {
            $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
        } else {
            if (!$hewanHalal) {
                $isHalal = 'Haram';
            } elseif (!$sembelihSyariat) {
                $isHalal = 'Jangan digunakan';
            } elseif ($pengolahanLanjutan) {
                $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
            } else {
                $isHalal = 'Halal';
            }
        }
        
        try {  
            $ScreeningHewani = $user->screeningProdukHewani()->create([
                'nama_produk' => $namaProduk,
                'jenis_bahan' => $jenisBahan,
                'nama_hewan' => $namaHewan,
                'hewan_halal' => $request->has('hewan-halal') ? true : false,
                'sembelih_syariat' => $request->has('sembelih-syariat') ? true : false,
                'pengolahan_lanjutan' => $request->has('pengolahan-lanjutan') ? true : false,
                'halal' => $isHalal,
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('screening.hewani')->with('error', 'Produk gagal disimpan.');
        }

        // return redirect()->route('ingredient.create', ['product_id' => $product->id])
        //     ->with('success', 'Produk berhasil disimpan.');
        return view('screening/create-hewani', \compact('namaProduk', 'jenisBahan', 'namaHewan', 'isHalal'));
    }

    public function destroy($screening_produk_hewani_id)
    {
        $deleted = ScreeningProdukHewani::findOrFail($screening_produk_hewani_id)->delete();

        if ($deleted) {
            return redirect()->route('screening.history-hewani')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus.');

        }
    }
}
