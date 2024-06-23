<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    public function createHewani()
    {
        return view('screening/create-hewani');
    }

    public function createNabati()
    {
        return view('screening/create-nabati');
    }

    public function createProdukJadi()
    {
        return view('screening/create-produk-jadi');
    }

    public function checkHalalHewani(Request $request)
    {
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

        return view('screening/create-hewani', \compact('namaProduk', 'jenisBahan', 'namaHewan', 'isHalal'));
    }

    public function checkHalalNabati(Request $request) {
        $namaProduk = $request->input('nama-produk');
        $namaBahan = $request->input('nama-bahan');
        $tidakDiolah = $request->has('tidak-diolah') ? true : false;
        $mikrobial = $request->has('mikrobial') ? true : false;
        $alkohol = $request->has('alkohol') ? true : false;
        $bahanPenolong = $request->has('bahan-penolong') ? true : false;

        $isHalal = 'Halal';

        if ($tidakDiolah) {
            $isHalal = 'Halal';
            return view('screening/create-nabati', \compact('namaProduk', 'namaBahan', 'isHalal'));
        }

        if ($mikrobial) {
            if ($alkohol) {
                $isHalal = 'Haram';
            } else {
                $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
            }
            
            return view('screening/create-nabati', \compact('namaProduk', 'namaBahan', 'isHalal'));
        }

        if ($bahanPenolong) {
            $isHalal = 'Titik Kritis, Perlu sertifikasi Halal';
            return view('screening/create-nabati', \compact('namaProduk', 'namaBahan', 'isHalal'));
        }

        return view('screening/create-nabati', \compact('namaProduk', 'namaBahan', 'isHalal'));
    }

    public function checkHalalProdukJadi(Request $request)
    {
        $namaProduk = $request->input('nama-produk');
        $daftarBahan = $request->input('daftar-bahan');
        $bahanPenolong = $request->has('bahan-penolong') ? true : false;

        $isHalal = 'Halal';

        $arrayDaftarBahan = explode(";", $daftarBahan);

        return view('screening/create-hewani', \compact('namaProduk', 'daftarBahan', 'isHalal'));
    }
}
