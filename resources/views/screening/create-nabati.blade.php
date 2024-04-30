@extends('../layout/' . $layout)

@section('subhead')
    <title>Screening Produk Nabati</title>
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
                                <label for="regular-form-1" class="form-label">Nama Bahan <span class="text-danger">*</span></label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Nama Bahan" name="nama-bahan" placeholder="Nama Hewan">
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox1" data-label="Tidak Diolah" name="tidak-diolah">
                                <label class="form-check-label" for="checkbox1">Apakah bahan tidak diolah?</label>
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="checkbox2" data-label="Mikrobial" name="mikrobial">
                                <label class="form-check-label" for="checkbox2">Apakah pengolahan menggunakan kultivasi mikrobial?</label>
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="3" id="checkbox3" data-label="Alkohol" name="alkohol">
                                <label class="form-check-label" for="checkbox3">Ada fermentasi khamr atau alkohol?</label>
                            </div>
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" value="4" id="checkbox4" data-label="Bahan Penolong" name="bahan-penolong">
                                <label class="form-check-label" for="checkbox4">Ada bahan tambahan atau penolong?</label>
                            </div>
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('product.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
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
        <p>Nama Bahan: {{ $namaBahan }}</p>
        <p>Status Halal: {{ $isHalal }}</p>
    </div>
    @endif

    <script>
        const checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                // Jika checkbox yang dipilih adalah checkbox1
                if (this.value == '1' && this.checked) {
                    // Nonaktifkan checkbox lain
                    checkboxes.forEach((cb) => {
                        if (cb.value != '1') {
                            cb.disabled = true;
                        }
                    });
                } else {
                    // Aktifkan kembali checkbox lain
                    checkboxes.forEach((cb) => {
                        cb.disabled = false;
                    });
                }

                if (this.value == '2' && this.checked) {
                    checkboxes.forEach((cb) => {
                        if (cb.value == '4') {
                            cb.disabled = true;
                        }
                    });
                } else {
                    checkboxes.forEach((cb) => {
                        cb.disabled = false;
                    });
                }
            });
        });
    </script>

@endsection
