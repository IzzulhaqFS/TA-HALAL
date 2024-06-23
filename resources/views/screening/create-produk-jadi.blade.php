@extends('../layout/' . $layout)

@section('subhead')
    <title>Screening Produk Jadi</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Screening Produk</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger mt-2" style="display: inline-block;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>    
    @endif
    <!-- BEGIN: Form -->
    <form id="create-product-form"  action="{{ route('screening.check-produk-jadi') }}"  method="POST">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Input -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                        <i class="text-xs mr-auto"><span class="text-danger">*</span>&nbsp;Wajib diisi</i>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Nama Produk" name="nama-produk" placeholder="Nama Produk">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Daftar Bahan Baku <span class="text-danger">* Pisahkan setiap bahan dengan tanda Titik koma (";")</span></label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Nama Bahan" name="nama-bahan" placeholder="Nama Hewan">
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox1" data-label="Bahan Penolong" name="bahan-penolong">
                                <label class="form-check-label" for="checkbox1">Apakah menggunakan bahan penolong?</label>
                            </div>
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('screening.history-produk-jadi') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                                <button id="submit-btn" type="submit" class="btn btn-primary w-24 inline-block">Hasil</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Input -->
            </div>
        </div>
    </form>
    <!-- END: Form -->

    @if(isset($namaProduk))
    <div class="mt-4">
        <h3>Hasil Screening</h3>
        <p>Nama Produk: {{ $namaProduk }}</p>
        <p>Daftar Bahan: {{ $daftarBahan }}</p>
        <p>Status Halal: {{ $isHalal }}</p>
    </div>
    @endif

@endsection
