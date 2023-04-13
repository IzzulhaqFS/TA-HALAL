@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Sertifikat Halal Bahan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        @if ($ingredient->type == 'Hewani')
        <h2 class="text-lg font-medium mr-auto main-activity" data-main-label="Cek Sertifikat Halal">
            Pengecekan Sertifikat Halal Bahan
        </h2>
        @else
        <h2 class="text-lg font-medium mr-auto main-activity" data-main-label="Cek sertifikat halal">
            Pengecekan Sertifikat Halal Bahan
        </h2>
        @endif
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
    @if(session('success'))
    <div class="alert alert-success mt-2" style="display: inline-block;">
        {{ session('success') }}
    </div>
    @endif
    <!-- BEGIN: Form -->
    <form id="create-ingredient-form"  action="{{ route('ingredient.store') }}"  method="POST">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Input -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Input</h2>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama Produk</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" disabled value="{{ $ingredient->product_name}}">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Nama Bahan</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" disabled name="name" value="{{ $ingredient->name }}">
                            </div>
                            for
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah Bahan Telah Bersertifikat Halal?</label>
                                <select id="is-halal-certified-select" class="form-control" name="is-halal-certified">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('is-halal-certified') == '1' ? 'selected' : '' }} class="sub-activity" data-label="Apakah Bahan Telah Bersertifikat Halal?">Iya</option>
                                    <option value="0" {{ old('is-halal-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-label="Apakah Bahan Telah Bersertifikat Halal?">Tidak</option>
                                </select>
                            </div>
                            {{-- BEGIN: Certificate Detail --}}
                            <div id="certificate-detail" class="certificate-detail">
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
                                    <input type="number" class="form-control sub-activity" data-label="Nomor Sertifikat" name="certificate-number" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
                                    <input type="number" class="form-control sub-activity" data-label="Lembaga Penerbit Sertifikat" name="certificate-institution" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Mulai Masa Berlaku</label>
                                    <input type="date" class="form-control sub-activity" data-label="Mulai Masa Berlaku" name="certificate-start-date" placeholder="Mulai Masa Berlaku">
                                </div>
                                @if ($ingredient->type == 'Nabati')
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Apakah lulus uji lab babi?</label>
                                    <input type="text" class="form-control sub-activity" data-label="Akhir Masa Berlaku" name="certificate-end-date" placeholder="Akhir Masa Berlaku">
                                </div>
                                @endif
                            </div>
                            {{-- END: Certificate Detail --}}

                            <script>
                                // Get a reference to the select element and the certificate-detail div
                                let selectEl = document.querySelector('#is-halal-certified-select');
                                let certDetailEl = document.querySelector('#certificate-detail');

                                // Add an event listener to the select element to listen for changes
                                selectEl.addEventListener('change', function() {
                                // Check if the selected value is "1"
                                if (selectEl.value === "1") {
                                    // If it is, show the certificate-detail div
                                    certDetailEl.style.display = 'block';
                                } else {
                                    // Otherwise, hide it
                                    certDetailEl.style.display = 'none';
                                }
                                });

                                // Call the event listener once on page load to set the initial state of the div
                                selectEl.dispatchEvent(new Event('change'));
                            </script>
                            <input id="regular-form-1" type="hidden" class="form-control sub-activity" data-label="product_id" name="ingredient_id" value="{{ $ingredient->id }}">
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

    <!-- BEGIN: Form Scripts -->
    <script src="{{ asset('dist/scripts/selectOptionModifier.js') }}"></script>
    <script src="{{ asset('dist/scripts/storeDataToSession.js') }}"></script>    
    <script>
        const getMainValue = () => {
            
        };
        </script>
    <script>
        storeDataToSession();
    </script>
    <!-- END: Form Scripts -->

@endsection
