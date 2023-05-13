@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Asal Bahan Daging</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Daging" 
            data-value="Syubhat">
            Pengecekan Asal Bahan Daging
        </h2>
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
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ $ingredient->product_name}}">
                        </div>
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Nama Bahan</label>
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ $ingredient->name }}">
                        </div>
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Bahan Baku</label>
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ $bahanBaku }}">
                        </div>
                        {{-- BEGIN: Form --}}
                        <form id="cek-daging-form" action="{{ route('hewani.kehalalan-bahan', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="ingredient_id" value="{{ $ingredient->id }}">
                                <label for="regular-form-1" class="form-label">Apakah hewan asal daging diketahui?</label>
                                <select id="cek-daging-select" class="form-control" name="cek-daging">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('cek-daging') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal daging diketahui?">Diketahui</option>
                                    <option value="0" {{ old('cek-daging') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal daging diketahui?">Tidak Diketahui</option>
                                </select>
                            </div>
    
                            {{-- BEGIN: Cek Asal Hewan Daging--}}
                            <div id="cek-asal-hewan-daging" class="cek-asal-hewan-daging main-activity" 
                                data-pos="1"
                                data-label="Cek Asal Hewan Bahan Daging"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah daging berasal dari hewan halal?</label>
                                    <select id="is-asal-hewan-halal-select" class="form-control" name="is-asal-hewan-halal">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('is-asal-hewan-halal') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah daging berasal dari hewan halal?">Iya</option>
                                        <option value="0" {{ old('is-asal-hewan-halal') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah daging berasal dari hewan halal?">Tidak</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Nama Hewan</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama Hewan" name="nama-hewan" placeholder="Nama Hewan">
                                </div>
                            </div>
                            {{-- END: Cek Asal Hewan Daging --}}
    
                            {{-- BEGIN: Cek Warna Daging --}}
                            <div id="cek-warna-daging" class="cek-warna-daging main-activity" 
                                data-pos="2"
                                data-label="Cek Warna Daging"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Bagaimana Warna Daging?</label>
                                    <select id="cek-warna-daging-select" class="form-control" name="cek-warna-daging">
                                        <option value="">-- Pilih --</option>
                                        <option value="merah-pucat" {{ old('cek-warna-daging') == 'merah-pucat' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bagaimana Warna Daging?">Merah Pucat</option>
                                        <option value="merah-tua" {{ old('cek-warna-daging') == 'merah-tua' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bagaimana Warna Daging?">Merah Tua</option>
                                        <option value="putih-pucat" {{ old('cek-warna-daging') == 'putih-pucat' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bagaimana Warna Daging?">Putih Pucat</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek Warna Daging --}} 

                            {{-- BEGIN: Cek Serat Daging --}}
                            <div id="cek-serat-daging" class="cek-serat-daging main-activity" 
                                data-pos="3"
                                data-label="Cek Serat Daging"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Bagaimana Serat Daging?</label>
                                    <select id="cek-serat-daging-select" class="form-control" name="cek-serat-daging">
                                        <option value="">-- Pilih --</option>
                                        <option value="halus-renggang" {{ old('cek-serat-daging') == 'halus-renggang' ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Bagaimana Serat Daging?">Halus & Renggang</option>
                                        <option value="kasar-rapat" {{ old('cek-serat-daging') == 'merah-tua' ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Bagaimana Serat Daging?">Kasar & Rapat</option>
                                        <option value="halus-rapat" {{ old('cek-serat-daging') == 'halus-rapat' ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Bagaimana Serat Daging?">Halus & Rapat</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek Serat Daging --}} 

                            {{-- BEGIN: Cek Tekstur Daging --}}
                            <div id="cek-tekstur-daging" class="cek-tekstur-daging main-activity" 
                                data-pos="4"
                                data-label="Cek Tekstur Daging"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Bagaimana Tekstur Daging?</label>
                                    <select id="cek-tekstur-daging-select" class="form-control" name="cek-tekstur-daging">
                                        <option value="">-- Pilih --</option>
                                        <option value="halus-renggang" {{ old('cek-tekstur-daging') == 'halus-renggang' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Halus & Renggang</option>
                                        <option value="kasar-rapat" {{ old('cek-tekstur-daging') == 'merah-tua' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Kasar & Rapat</option>
                                        <option value="halus-rapat" {{ old('cek-tekstur-daging') == 'halus-rapat' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Halus & Rapat</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek Tekstur Daging --}} 
                        </form>
                        {{-- END: Form --}}
                        <div id="mover-container" class="mt-5">
                            <a href="{{ route('product.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                            <button id="right-btn" type="submit" class="btn btn-primary w-24 inline-block">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Input -->
        </div>
    </div>
    <!-- END: Form -->

    @include('../layout/components/processing-script')

    {{-- BEGIN: Additional Scripts --}}
    <script>
        // Display Certificate Detail if isNotBabiCertified 
        // Get a reference to the select element and the cek-asal-hewan-daging div
        let kelompokBahanSelectEl = document.querySelector('#cek-daging-select');
        let bahanSembelihDetailEl = document.querySelector('#cek-asal-hewan-daging');
        let bahanNonsembelihDetailEl = document.querySelector('#cek-warna-daging');
        
        kelompokBahanSelectEl.addEventListener('change', function() {
            if (kelompokBahanSelectEl.value === "sembelih") {
                bahanSembelihDetailEl.style.display = 'block';
                bahanSembelihDetailEl.setAttribute('data-value', 'Syubhat');
                
                bahanNonsembelihDetailEl.style.display = 'block';
                bahanNonsembelihDetailEl.setAttribute('data-value', '');
            } else {
                bahanNonembelihDetailEl.style.display = 'block';
                bahanNonembelihDetailEl.setAttribute('data-value', 'Syubhat');

                bahanSembelihDetailEl.style.display = 'none';
                bahanSembelihDetailEl.setAttribute('data-value', '');
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        kelompokBahanSelectEl.dispatchEvent(new Event('change'));
    </script>
    
    <script>
        // Process Activity if isNotBabiCertified
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let form = document.querySelector('#cek-daging-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
