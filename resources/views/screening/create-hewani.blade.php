@extends('../layout/' . $layout)

@section('subhead')
    <title>Screening Produk Hewani</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Screening Produk Hewani</h2>
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
    <form id="create-product-form"  action="{{ route('screening.check-hewani') }}"  method="POST">
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
                                <label for="form-control-select-1" class="form-label">Pilih Jenis Bahan <span class="text-danger">*</span></label>
                                <select id="form-control-select-1" class="form-control" data-label="Jenis Bahan" name="jenis-bahan" placeholder="Pilih Jenis Bahan">
                                    <option>Telur</option>
                                    <option>Susu</option>
                                    <option>Madu</option>
                                    <option>Ikan</option>
                                    <option>Kulit</option>
                                    <option>Daging</option>
                                    <option>Tulang</option>
                                    <option>Lemak</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">Nama Hewan <span class="text-danger">*</span></label>
                                <input id="regular-form-2" type="text" class="form-control sub-activity" data-label="Nama Hewan" name="nama-hewan" placeholder="Nama Hewan">
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox1" data-label="Hewan Halal" name="hewan-halal">
                                <label class="form-check-label" for="checkbox1">Apakah bahan yang digunakan berasal dari hewan halal?</label>
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="checkbox2" data-label="Sembelih Syariat" name="sembelih-syariat">
                                <label class="form-check-label" for="checkbox2">Apakah hewan yang digunakan disembelih sesuai dengan Syariat Islam?</label>
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="3" id="checkbox3" data-label="Pengolahan Lanjutan" name="pengolahan-lanjutan">
                                <label class="form-check-label" for="checkbox3">Apakah ada pengolahan lanjutan pada bahan baku?</label>
                            </div>
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('screening.history-hewani') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
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
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <div class="intro-y box">
                <h2 class="text-lg font-medium mr-auto main-activity p-5">{{ $isHalal }}</h2>
            </div>
        </div>
    </div>
    @endif

@endsection


