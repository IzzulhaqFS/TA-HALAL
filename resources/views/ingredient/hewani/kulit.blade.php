@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Bahan Kulit</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Kulit" 
            data-value="Syubhat">
            Pengecekan Bahan Kulit
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
                        <form id="cek-kulit-form" action="{{ route('hewani.bahan-baku.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="bahan-baku" value="{{ $bahanBaku }}">
                                <input id="kehalalan-bahan" type="hidden" class="form-control" name="kehalalan-bahan" value="Syubhat">
                                
                                <label for="regular-form-1" class="form-label">Apakah hewan asal kulit diketahui? <span class="text-danger">*</span></label>
                                <select id="asal-hewan-diketahui-select" class="form-control" name="asal-hewan-diketahui">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('asal-hewan-diketahui') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal kulit diketahui?">Diketahui</option>
                                    <option value="0" {{ old('asal-hewan-diketahui') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal kulit diketahui?">Tidak Diketahui</option>
                                </select>
                            </div>
    
                            {{-- BEGIN: Cek Asal Hewan Kulit--}}
                            <div id="asal-hewan-halal" class="asal-hewan-halal main-activity" 
                                data-pos="1"
                                data-label="Cek Asal Hewan Bahan Kulit"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah kulit berasal dari hewan halal? <span class="text-danger">*</span></label>
                                    <select id="asal-hewan-select" class="form-control" name="asal-hewan">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('asal-hewan') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah kulit berasal dari hewan halal?">Iya</option>
                                        <option value="0" {{ old('asal-hewan') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah kulit berasal dari hewan halal?">Tidak</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Nama Hewan</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama Hewan" name="nama-hewan" placeholder="Nama Hewan">
                                </div>
                            </div>
                            {{-- END: Cek Asal Hewan Kulit --}}
    
                            {{-- BEGIN: Cek Permukaan Kulit --}}
                            <div id="uji-permukaan-detail" class="uji-permukaan-detail main-activity" 
                                data-pos="2"
                                data-label="Cek Permukaan Kulit"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah terdapat tiga titik yang berdekatan pada permukaan kulit?</label>
                                    <select id="hasil-uji-permukaan-select" class="form-control" name="hasil-uji-lab">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('hasil-uji-lab') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Hasil Uji Lab">Ada</option>
                                        <option value="0" {{ old('hasil-uji-lab') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Hasil Uji Lab">Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek Permukaan Kulit --}} 
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
    @include('../layout/components/predict')

    {{-- BEGIN: Additional Scripts --}}
    <script>
        let asalHewanHalalEl = document.querySelector('#asal-hewan-halal');
        let ujiPermukaanEl = document.querySelector('#uji-permukaan-detail');
        let asalHewanDiketahuiSelectEl = document.querySelector('#asal-hewan-diketahui-select');
        
        asalHewanDiketahuiSelectEl.addEventListener('change', function() {
            if (asalHewanDiketahuiSelectEl.value === "1") {
                displayElements(asalHewanHalalEl);
                hideElements(ujiPermukaanEl);
                removeActivityValue(ujiPermukaanEl);
            } else if (asalHewanDiketahuiSelectEl.value === "0"){
                displayElements(ujiPermukaanEl);
                hideElements(asalHewanHalalEl);
                removeActivityValue(asalHewanHalalEl);
            } else {
                hideElements(asalHewanHalalEl, ujiPermukaanEl);
                removeActivityValue(asalHewanHalalEl, ujiPermukaanEl);
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        asalHewanDiketahuiSelectEl.dispatchEvent(new Event('change'));
    </script>
    <script>
        let asalHewanHalalSelectEl = document.querySelector('#asal-hewan-select');
        let HasilUjiPermukaanSelectEl = document.querySelector('#hasil-uji-permukaan-select');

        asalHewanHalalSelectEl.addEventListener('change', function() {
            if (asalHewanHalalSelectEl.value === "1") {
                asalHewanHalalEl.setAttribute('data-value', 'Halal');
            } else if (asalHewanHalalSelectEl.value === "0") {
                asalHewanHalalEl.setAttribute('data-value', 'Haram');
            } else {
                asalHewanHalalEl.setAttribute('data-value', '');
            }
        });

        HasilUjiPermukaanSelectEl.addEventListener('change', function() {
            if (HasilUjiPermukaanSelectEl.value === "1") {
                ujiPermukaanEl.setAttribute('data-value', 'Haram');
            } else if (HasilUjiPermukaanSelectEl.value === "0"){
                ujiPermukaanEl.setAttribute('data-value', 'Halal');
            } else {
                ujiPermukaanEl.setAttribute('data-value', '');
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
            
            let form = document.querySelector('#cek-kulit-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}
@endsection
