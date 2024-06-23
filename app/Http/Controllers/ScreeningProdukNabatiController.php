<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreeningProdukNabati;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScreeningProdukNabatiController extends Controller
{
    public function index()
    {
        $products = DB::table('screening_nabati as n')
            ->select(
                'n.id', 'n.user_id', 'n.nama_produk', 'n.nama_bahan', 'n.halal'
            )
            ->where('n.user_id', '=', Auth::user()->id)
            ->groupBy('n.id', 'n.user_id', 'n.nama_produk', 'n.nama_bahan', 'n.halal')
            ->paginate(10);

        return view('screening/history-nabati', \compact('products'));
    }

    public function create()
    {
        return view('screening/create-nabati');
    }

    public function store(Request $request) 
    {
        $user = Auth::user();
        $namaProduk = $request->input('nama-produk');
        $namaBahan = $request->input('nama-bahan');
        $tidakDiolah = $request->has('tidak-diolah') ? true : false;
        $mikrobial = $request->has('mikrobial') ? true : false;
        $alkohol = $request->has('alkohol') ? true : false;
        $bahanPenolong = $request->has('bahan-penolong') ? true : false;

        $isHalal = 'Halal';

        if ($tidakDiolah) {
            $isHalal = 'Halal';
        } else {
            if ($mikrobial) {
                if ($alkohol) {
                    $isHalal = 'Haram';
                } else {
                    $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
                }
            } else {
                if ($bahanPenolong) {
                    $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
                }
            }
        }

        try {  
            $ScreeningNabati = $user->screeningProdukNabati()->create([
                'nama_produk' => $namaProduk,
                'nama_bahan' => $namaBahan,
                'tidak_diolah' => $tidakDiolah,
                'mikrobial' => $mikrobial,
                'alkohol' => $alkohol,
                'bahan_penolong' => $bahanPenolong,
                'halal' => $isHalal,
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
    
            return redirect()->route('screening.nabati')->with('error', 'Produk gagal disimpan.');
        }

        // return redirect()->route('ingredient.create', ['product_id' => $product->id])
        //     ->with('success', 'Produk berhasil disimpan.');
        return view('screening/create-nabati', \compact('namaProduk', 'namaBahan', 'isHalal'));
    }

    public function destroy($screening_produk_nabati_id)
    {
        $deleted = ScreeningProdukNabati::findOrFail($screening_produk_nabati_id)->delete();

        if ($deleted) {
            return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus.');

        }
    }

    // public function checkHalalHewani(Request $request)
    // {
    //     $namaProduk = $request->input('nama-produk');
    //     $jenisBahan = $request->input('jenis-bahan');
    //     $namaHewan = $request->input('nama-hewan');
    //     $hewanHalal = $request->has('hewan-halal') ? true : false;
    //     $sembelihSyariat = $request->has('sembelih-syariat') ? true : false;
    //     $pengolahanLanjutan = $request->has('pengolahan-lanjutan') ? true : false;

    //     $isHalal = '';

    //     if (($jenisBahan == 'Telur' || $jenisBahan == 'Susu' || $jenisBahan == 'Madu' || $jenisBahan == 'Ikan') && !$pengolahanLanjutan) {
    //         $isHalal = 'Halal';
    //     } elseif (($jenisBahan == 'Telur' || $jenisBahan == 'Susu' || $jenisBahan == 'Madu' || $jenisBahan == 'Ikan') && $pengolahanLanjutan) {
    //         $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
    //     } else {
    //         if (!$hewanHalal) {
    //             $isHalal = 'Haram';
    //         } elseif (!$sembelihSyariat) {
    //             $isHalal = 'Jangan digunakan';
    //         } elseif ($pengolahanLanjutan) {
    //             $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
    //         } else {
    //             $isHalal = 'Halal';
    //         }
    //     }

    //     // return view('screening/create-hewani', \compact('namaProduk', 'jenisBahan', 'namaHewan', 'isHalal'));
    //     return $isHalal;
    // }
}
