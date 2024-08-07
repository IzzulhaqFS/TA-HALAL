@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Gelatin</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg mr-auto">
            Pengecekan Gelatin
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
                            <label for="regular-form-1" class="form-label">Kelompok Bahan</label>
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ ucfirst($kelompokBahan) }}">
                        </div>
                        {{-- BEGIN: Form --}}
                        <form id="titik-kritis-form" action="{{ route('nabati.titik-kritis', [
                            'ingredient_id' => $ingredient->id, 'kelompok-bahan' => $kelompokBahan, 'bahan-kritis' => $listBahanKritis , 'index' => ((int) $index + 1) ]) }}" 
                            method="GET">
                            {{-- BEGIN: DATA POS 0 --}}
                            <div id="dp0" class="main-activity" style="display: block;" 
                                data-pos="0" 
                                data-label="Cek COA gelatin" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label font-medium">Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin?</label>
                                    <select id="dp0_1" class="form-control" name="dp0_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp0_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin?">Ada</option>
                                        <option value="0" {{ old('dp0_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin?">Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 0 --}}

                            {{-- BEGIN: DATA POS 1 --}}
                            <div id="dp1" class="main-activity" style="display: none;"
                                data-pos="1"
                                data-label="Cek informasi COA gelatin"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor COA</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nomor COA" name="coa-number" placeholder="Nomor COA">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Parameter</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Parameter" name="parameter" placeholder="Parameter">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Metode</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Metode" name="metode" placeholder="Metode">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Hasil Uji Lab</label>
                                    <select id="dp1_1" class="form-control" name="hasil-uji-lab">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('hasil-uji-lab') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Hasil Uji Lab">Terdeteksi</option>
                                        <option value="0" {{ old('hasil-uji-lab') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Hasil Uji Lab">Tidak terdeteksi</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 1 --}}
                            
                            {{-- BEGIN: DATA POS 2 --}}
                            <div id="dp2" class="main-activity" style="display: none;" 
                                data-pos="2" 
                                data-label="Cek kehalalan hewan (gelatin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan hewan sumber pelapis pada gelatin?</label>
                                    <select id="dp2_1" class="form-control" name="dp2_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp2_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Kehalalan hewan sumber pelapis pada gelatin?">Halal</option>
                                        <option value="Haram" {{ old('dp2_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Kehalalan hewan sumber pelapis pada gelatin?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 2 --}}
                            
                            {{-- BEGIN: DATA POS 3 --}}
                            <div id="dp3" class="main-activity" style="display: none;" 
                                data-pos="3" 
                                data-label="Cek metode penyembelihan (gelatin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?</label>
                                    <select id="dp3_1" class="form-control" name="dp3_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp3_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?">Iya</option>
                                        <option value="0" {{ old('dp3_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 3 --}}
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
        let dp0 = document.querySelector('#dp0');
        let dp1 = document.querySelector('#dp1');
        let dp2 = document.querySelector('#dp2');
        let dp3 = document.querySelector('#dp3');
        let dp0_1 = document.querySelector('#dp0_1');
        let dp1_1 = document.querySelector('#dp1_1');
        let dp8_1 = document.querySelector('#dp8_1');
        let dp3_1 = document.querySelector('#dp3_1');

    </script>
    <script>
        // Display anak ke-1. Hide dan bersihkan isi anak yg lbh dari ke-1 dan cabangnya
        
        // Apakah terdapat hasil uji lab babi
        dp0_1.addEventListener('change', function() {
            if (dp0_1.value ===  "1") {
                dp0.setAttribute('data-value', 'Syubhat');
                displayElements(dp1);
                hideElements(dp2, dp3);
                removeActivityValue(dp2, dp3);
            } else if (dp0_1.value ===  "0") {
                dp0.setAttribute('data-value', 'Syubhat');
                displayElements(dp2);
                hideElements(dp1);
                removeActivityValue(dp1);
            } else {
                dp0.setAttribute('data-value', '');
                hideElements(dp1, dp2, dp3);
                removeActivityValue(dp1, dp2, dp3);
            }
        });

        // Hasil Uji Lab babi
        dp1_1.addEventListener('change', function() {
            if (dp1_1.value ===  "0") {
                dp1.setAttribute('data-value', 'Halal');
            } else if (dp1_1.value ===  "1") {
                dp1.setAttribute('data-value', 'Haram');
            } else {
                dp1.setAttribute('data-value', '');
            }
        });

        // Kehalalan hewan sumber pelapis pada gelatin?
        dp2_1.addEventListener('change', function() {
            if (dp2_1.value ===  "Halal") {
                dp2.setAttribute('data-value', 'Halal');
                displayElements(dp3);
            } else {
                if (dp2_1.value ===  "Haram") {
                    dp2.setAttribute('data-value', 'Haram');
                }
                hideElements(dp3);
                removeActivityValue(dp3);
            }
        });

        // Apakah metode penyembelihan syar'i?
        dp3_1.addEventListener('change', function() {
            if (dp3_1.value ===  "1") {
                dp3.setAttribute('data-value', 'Halal');
            } else if (dp3_1.value ===  "0"){
                dp3.setAttribute('data-value', 'Haram');
            } else {
                dp3.setAttribute('data-value', '');
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        dp0_1.dispatchEvent(new Event('change'));
    </script>


    {{-- Jika sudah di hal akhir bahan kritis --}}
    @if (count(explode(",", $listBahanKritis)) == ($index + 1))
    <script>
        document.getElementById('right-btn').innerText = 'Ambil Kesimpulan';
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            await processActivity('{{ csrf_token() }}', 'rule');
        })
    </script>
    @else
    <script>
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let form = document.querySelector('#titik-kritis-form');
            window.location.href = form.action;
        })
    </script>
    @endif
    {{-- END: Additional Scripts --}}
@endsection
