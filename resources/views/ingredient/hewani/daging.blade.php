@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Bahan Daging</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Daging" 
            data-value="Syubhat">
            Pengecekan Bahan Daging
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
                <div class="flex flex-col sm:flex-row items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                    <i class="text-xs mr-auto"><span class="text-danger">*</span>&nbsp;Wajib diisi</i>
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
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ ucfirst($bahanBaku) }}">
                        </div>
                        {{-- BEGIN: Form --}}
                        <form id="cek-daging-form" action="{{ route('hewani.bahan-baku.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="ingredient-id" value="{{ $ingredient->id }}">
                                <input type="hidden" class="form-control" name="bahan-baku" value="{{ $bahanBaku }}">
                                <input id="kehalalan-bahan" type="hidden" class="form-control" name="kehalalan-bahan" value="Syubhat">

                                <label for="regular-form-1" class="form-label">Apakah hewan asal daging diketahui? <span class="text-danger">*</span></label>
                                <select id="asal-hewan-diketahui-select" class="form-control" name="asal-hewan-diketahui">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('asal-hewan-diketahui') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal daging diketahui?">Diketahui</option>
                                    <option value="0" {{ old('asal-hewan-diketahui') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal daging diketahui?">Tidak Diketahui</option>
                                </select>
                            </div>
    
                            {{-- BEGIN: Cek Asal Hewan Daging--}}
                            <div id="asal-hewan-halal" class="asal-hewan-halal main-activity" 
                                data-pos="1"
                                data-label="Cek Asal Hewan Bahan Daging"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah daging berasal dari hewan halal? <span class="text-danger">*</span></label>
                                    <select id="asal-hewan-halal-select" class="form-control" name="asal-hewan-halal">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('asal-hewan-halal') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah daging berasal dari hewan halal?">Iya</option>
                                        <option value="0" {{ old('asal-hewan-halal') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah daging berasal dari hewan halal?">Tidak</option>
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
                                        <option value="kasar-rapat" {{ old('cek-serat-daging') == 'kasar-rapat' ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Bagaimana Serat Daging?">Kasar & Rapat</option>
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
                                        <option value="lunak-kenyal" {{ old('cek-tekstur-daging') == 'lunak-kenyal' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Lunak & Kenyal</option>
                                        <option value="padat-kaku" {{ old('cek-tekstur-daging') == 'padat-kaku' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Padat & Kaku</option>
                                        <option value="lembut" {{ old('cek-tekstur-daging') == 'lembut' ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Bagaimana Tekstur Daging?">Lembut</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek Tekstur Daging --}} 
                        </form>
                        {{-- END: Form --}}
                        <div id="mover-container" class="mt-5">
                            <a href="javascript:void(0)" onclick="history.back()" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
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
        let asalHewanHalalEl = document.querySelector('#asal-hewan-halal');
        let cekWarnaEl = document.querySelector('#cek-warna-daging');
        let cekSeratEl = document.querySelector('#cek-serat-daging');
        let cekTeksturEl = document.querySelector('#cek-tekstur-daging');
        let asalHewanDiketahuiSelectEl = document.querySelector('#asal-hewan-diketahui-select');
        
        asalHewanDiketahuiSelectEl.addEventListener('change', function() {
            if (asalHewanDiketahuiSelectEl.value === "1") {
                asalHewanHalalEl.style.display = 'block';

                cekWarnaEl.style.display = 'none';
                cekSeratEl.style.display = 'none';
                cekTeksturEl.style.display = 'none';
                removeActivityValue(cekWarnaEl);
                removeActivityValue(cekSeratEl);
                removeActivityValue(cekTeksturEl);
            } else if (asalHewanDiketahuiSelectEl.value === "0"){
                cekWarnaEl.style.display = 'block';
                cekSeratEl.style.display = 'block';
                cekTeksturEl.style.display = 'block';
                
                asalHewanHalalEl.style.display = 'none';
                removeActivityValue(asalHewanHalalEl);
            } else {
                asalHewanHalalEl.style.display = 'none';
                cekWarnaEl.style.display = 'none';
                cekSeratEl.style.display = 'none';
                cekTeksturEl.style.display = 'none';

                removeActivityValue(asalHewanHalalEl);
                removeActivityValue(cekWarnaEl);
                removeActivityValue(cekSeratEl);
                removeActivityValue(cekTeksturEl);
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        asalHewanDiketahuiSelectEl.dispatchEvent(new Event('change'));
    </script>
    <script>
        let asalHewanHalalSelectEl = document.querySelector('#asal-hewan-halal-select');
        let cekWarnaSelectEl = document.querySelector('#cek-warna-daging-select');
        let cekSeratSelectEl = document.querySelector('#cek-serat-daging-select');
        let cekTeksturSelectEl = document.querySelector('#cek-tekstur-daging-select');

        asalHewanHalalSelectEl.addEventListener('change', function() {
            if (asalHewanHalalSelectEl.value === "1") {
                asalHewanHalalEl.setAttribute('data-value', 'Halal');
            } else if (asalHewanHalalSelectEl.value === "0") {
                asalHewanHalalEl.setAttribute('data-value', 'Haram');
            } else {
                asalHewanHalalEl.setAttribute('data-value', '');
            }
        });

        cekWarnaSelectEl.addEventListener('change', function() {
            if (cekWarnaSelectEl.value === "merah-pucat") {
                cekWarnaEl.setAttribute('data-value', 'Haram');
            } else if (cekWarnaSelectEl.value === "") {
                cekWarnaEl.setAttribute('data-value', '');
            } else {
                cekWarnaEl.setAttribute('data-value', 'Halal');
            }
        });

        cekSeratSelectEl.addEventListener('change', function() {
            if (cekSeratSelectEl.value === "halus-renggang") {
                cekSeratEl.setAttribute('data-value', 'Haram');
            } else if (cekSeratSelectEl.value === "") {
                cekSeratEl.setAttribute('data-value', '');
            } else {
                cekSeratEl.setAttribute('data-value', 'Halal');
            }
        });

        cekTeksturSelectEl.addEventListener('change', function() {
            if (cekTeksturSelectEl.value === "lunak-kenyal") {
                cekTeksturEl.setAttribute('data-value', 'Haram');
            } else if (cekTeksturSelectEl.value === "") {
                cekTeksturEl.setAttribute('data-value', '');
            } else {
                cekTeksturEl.setAttribute('data-value', 'Halal');
            }
        });

    </script>


    <script>
        
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let kehalalanBahanEl = document.querySelector('#kehalalan-bahan');
            kehalalanBahanEl.value = 'Syubhat';
            
            let mainActivityElems = document.querySelectorAll('.main-activity');
            for (let i = 0; i < mainActivityElems.length; i++) {
                let val = mainActivityElems[i].getAttribute('data-value');;
                if (val === 'Haram') {
                    kehalalanBahanEl.value = 'Haram';
                    break;
                };
                if (val === 'Halal') {
                    kehalalanBahanEl.value = 'Halal';
                };
            }
            
            let form = document.querySelector('#cek-daging-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}
@endsection
