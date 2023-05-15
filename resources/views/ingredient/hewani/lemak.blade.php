@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Bahan Lemak</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Lemak" 
            data-value="Syubhat">
            Pengecekan Bahan Lemak
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
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ ucfirst($bahanBaku) }}">
                        </div>
                        {{-- BEGIN: Form --}}
                        <form id="cek-lemak-form" action="{{ route('hewani.bahan-baku.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="ingredient_id" value="{{ $ingredient->id }}">
                                <input type="hidden" class="form-control" name="bahanBaku" value="{{ $bahanBaku }}">
                                <input id="kehalalan-bahan" type="hidden" class="form-control" name="kehalalan-bahan" value="">
                                
                                <label for="regular-form-1" class="form-label">Apakah hewan asal lemak diketahui?</label>
                                <select id="asal-hewan-diketahui-select" class="form-control" name="asal-hewan-diketahui">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('asal-hewan-diketahui') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal lemak diketahui?">Diketahui</option>
                                    <option value="0" {{ old('asal-hewan-diketahui') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah hewan asal lemak diketahui?">Tidak Diketahui</option>
                                </select>
                            </div>
    
                            {{-- BEGIN: Cek Asal Hewan Lemak--}}
                            <div id="asal-hewan-halal" class="asal-hewan-halal main-activity" 
                                data-pos="1"
                                data-label="Cek Asal Hewan Bahan Lemak"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah lemak berasal dari hewan halal?</label>
                                    <select id="asal-hewan-select" class="form-control" name="asal-hewan">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('asal-hewan') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah lemak berasal dari hewan halal?">Iya</option>
                                        <option value="0" {{ old('asal-hewan') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah lemak berasal dari hewan halal?">Tidak</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Nama Hewan</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama Hewan" name="nama-hewan" placeholder="Nama Hewan">
                                </div>
                            </div>
                            {{-- END: Cek Asal Hewan Lemak --}}
    
                            {{-- BEGIN: Cek COA Babi Lemak --}}
                            <div id="uji-babi-detail" class="uji-babi-detail main-activity" 
                                data-pos="2"
                                data-label="Cek COA DNA Babi pada Lemak"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor COA</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Nomor COA" name="coa-number" placeholder="Nomor COA">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Parameter</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Parameter" name="parameter" placeholder="Parameter">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Metode</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Metode" name="metode" placeholder="Metode">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Hasil Uji Lab</label>
                                    <select id="hasil-uji-lab-select" class="form-control" name="hasil-uji-lab">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('hasil-uji-lab') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Hasil Uji Lab">Terdeteksi</option>
                                        <option value="0" {{ old('hasil-uji-lab') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Hasil Uji Lab">Tidak terdeteksi</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek COA Babi Lemak --}} 
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
        let ujiBabiDetailEl = document.querySelector('#uji-babi-detail');
        let asalHewanDiketahuiSelectEl = document.querySelector('#asal-hewan-diketahui-select');
        
        asalHewanDiketahuiSelectEl.addEventListener('change', function() {
            if (asalHewanDiketahuiSelectEl.value === "1") {
                asalHewanHalalEl.style.display = 'block';

                ujiBabiDetailEl.style.display = 'none';
                removeActivityValue(ujiBabiDetailEl);
            } else if (asalHewanDiketahuiSelectEl.value === "0"){
                ujiBabiDetailEl.style.display = 'block';
                
                asalHewanHalalEl.style.display = 'none';
                removeActivityValue(asalHewanHalalEl);
            } else {
                asalHewanHalalEl.style.display = 'none';
                ujiBabiDetailEl.style.display = 'none';

                removeActivityValue(asalHewanHalalEl);
                removeActivityValue(ujiBabiDetailEl);
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        asalHewanDiketahuiSelectEl.dispatchEvent(new Event('change'));
    </script>
    <script>
        let asalHewanHalalSelectEl = document.querySelector('#asal-hewan-select');
        let HasilUjiBabiSelectEl = document.querySelector('#hasil-uji-lab-select');

        asalHewanHalalSelectEl.addEventListener('change', function() {
            if (asalHewanHalalSelectEl.value === "1") {
                asalHewanHalalEl.setAttribute('data-value', 'Halal');
            } else if (asalHewanHalalSelectEl.value === "0") {
                asalHewanHalalEl.setAttribute('data-value', 'Haram');
            } else {
                asalHewanHalalEl.setAttribute('data-value', '');
            }
        });

        HasilUjiBabiSelectEl.addEventListener('change', function() {
            if (HasilUjiBabiSelectEl.value === "1") {
                ujiBabiDetailEl.setAttribute('data-value', 'Haram');
            } else if (HasilUjiBabiSelectEl.value === "0"){
                ujiBabiDetailEl.setAttribute('data-value', 'Halal');
            } else {
                ujiBabiDetailEl.setAttribute('data-value', '');
            }
        });
    </script>

    <script>
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let kehalalanBahanEl = document.querySelector('#kehalalan-bahan');
            kehalalanBahanEl.value = 'Halal';
            
            let mainActivityElems = document.querySelectorAll('.main-activity');
            mainActivityElems.forEach(function (elem, index) {
                let val = elem.getAttribute('data-value');
    
                if (val === 'Haram') {
                    kehalalanBahanEl.value = 'Haram';
                };
            });
            
            let form = document.querySelector('#cek-lemak-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}
@endsection
