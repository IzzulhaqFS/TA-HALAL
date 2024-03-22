@extends('../layout/' . $layout)

@section('subhead')
    <title>Screening Produk Hewani</title>
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
    <form id="create-product-form"  action="{{ route('product.store') }}"  method="POST">
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
                                <label for="regular-form-1" class="form-label">Apakah bahan yang digunakan berasal dari babi?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioYa" id="inlineRadio1" value="Ya">
                                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioTidak" id="inlineRadio2" value="Tidak">
                                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah bahan yang digunakan berasal dari hewan buas atau pemakan daging?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioYa" id="inlineRadio3" value="Ya">
                                    <label class="form-check-label" for="inlineRadio3">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioTidak" id="inlineRadio4" value="Tidak">
                                    <label class="form-check-label" for="inlineRadio4">Tidak</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah bahan yang digunakan berasal dari bagian tubuh hewan? Daging, kulit, atau tulang</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioYa" id="inlineRadio5" value="Ya">
                                    <label class="form-check-label" for="inlineRadio5">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioTidak" id="inlineRadio6" value="Tidak">
                                    <label class="form-check-label" for="inlineRadio6">Tidak</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah produk menggunakan bahan tambahan selain bahan baku?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioYa" id="inlineRadio7" value="Ya">
                                    <label class="form-check-label" for="inlineRadio7">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioTidak1" id="inlineRadio8" value="Tidak">
                                    <label class="form-check-label" for="inlineRadio8">Tidak</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah produk menggunakan bahan berikut? Susu, telur, madu, atau ikan</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioYa" id="inlineRadio9" value="Ya">
                                    <label class="form-check-label" for="inlineRadio9">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioTidak" id="inlineRadio10" value="Tidak">
                                    <label class="form-check-label" for="inlineRadio10">Tidak</label>
                                </div>
                            </div>
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('product.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                                <button id="submit-btn" type="submit" class="btn btn-primary w-24 inline-block">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Input -->
            </div>
        </div>
    </form>
    <!-- END: Form -->
@endsection
