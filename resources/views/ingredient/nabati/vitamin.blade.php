@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Vitamin</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg mr-auto">
            Pengecekan Vitamin
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
                                data-label="Cek sertifikat halal vitamin" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label font-medium">Apakah vitamin telah bersertifikat halal?</label>
                                    <select id="dp0_1" class="form-control" name="dp0_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp0_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah vitamin telah bersertifikat halal?">Iya</option>
                                        <option value="0" {{ old('dp0_1') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah vitamin telah bersertifikat halal?">Belum</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 0 --}}
                            
                            {{-- BEGIN: DATA POS 1 --}}
                            <div id="dp1" class="main-activity" style="display: none;" 
                                data-pos="1" 
                                data-label="Cek informasi sertifikat halal vitamin" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nomor Sertifikat" name="certificate-number" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Lembaga Penerbit Sertifikat" name="certificate-institution" placeholder="Lembaga Penerbit Sertifikat">
                                </div>
                                <div style="display: flex; flex-wrap: wrap;" class="mt-1">
                                    <div class="mt-3">
                                        <label for="regular-form-1" class="form-label">Akhir Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos="1" data-label="Akhir Masa Berlaku" name="certificate-end-date" placeholder="Akhir Masa Berlaku">
                                    </div>
                                </div>
                            </div>
                            {{-- END: DATA POS 1 --}}
                            
                            {{-- BEGIN: DATA POS 2 --}}
                            <div id="dp2" class="main-activity" style="display: none;" 
                                data-pos="2" 
                                data-label="Cek kandungan vitamin" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Vitamin berasal dari proses mikrobial?</label>
                                    <select id="dp2_1" class="form-control" name="dp2_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp2_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Vitamin berasal dari proses mikrobial?">Iya</option>
                                        <option value="0" {{ old('dp2_1') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Vitamin berasal dari proses mikrobial?">Tidak</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Ada penggunaan bahan penyalut (coating) pada vitamin?</label>
                                    <select id="dp2_2" class="form-control" name="dp2_2">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp2_2') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Ada penggunaan bahan penyalut (coating) pada vitamin?">Ada</option>
                                        <option value="0" {{ old('dp2_2') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Ada penggunaan bahan penyalut (coating) pada vitamin?">Tidak Ada</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 2 --}}
                            
                            {{-- BEGIN: DATA POS 3 --}}
                            <div id="dp3" class="main-activity" style="display: none;" 
                                data-pos="3" 
                                data-label="Cek proses produksi mikrobial (vitamin)" 
                                data-value="">
                                <hr class="mt-6" style="border-top-width: 2px">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Proses produksi vitamin?</label>
                                    <select id="dp3_1" class="form-control" name="dp3_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tanpa pemisahan dari media pertumbuhan" {{ old('dp3_1') == "Tanpa pemisahan dari media pertumbuhan" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="3" 
                                            data-label="Proses produksi vitamin?">Tanpa pemisahan dari media pertumbuhan</option>
                                        <option value="Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i" {{ old('dp3_1') == "Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="3" 
                                            data-label="Proses produksi vitamin?">Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i</option>
                                        <option value="Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i" {{ old('dp3_1') == "Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="3" 
                                            data-label="Proses produksi vitamin?">Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 3 --}}
                            
                            {{-- BEGIN: DATA POS 4 --}}
                            <div id="dp4" class="main-activity" style="display: none;" 
                                data-pos="4" 
                                data-label="Cek kehalalan media pertumbuhan (vitamin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan media pertumbuhan vitamin?</label>
                                    <select id="dp4_1" class="form-control" name="dp4_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp4_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Kehalalan media pertumbuhan vitamin?">Halal</option>
                                        <option value="Haram" {{ old('dp4_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Kehalalan media pertumbuhan vitamin?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 4 --}}
                            
                            {{-- BEGIN: DATA POS 5 --}}
                            <div id="dp5" class="main-activity" style="display: none;" 
                                data-pos="5" 
                                data-label="Cek pelapis vitamin" 
                                data-value="">
                                <hr class="mt-6" style="border-top-width: 2px">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Pelapis berasal dari hewan (contoh: gelatin)?</label>
                                    <select id="dp5_1" class="form-control" name="dp5_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp5_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="5" data-label="Pelapis berasal dari hewan (contoh: gelatin)?">Iya</option>
                                        <option value="0" {{ old('dp5_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="5" data-label="Pelapis berasal dari hewan (contoh: gelatin)?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 5 --}}
                            
                            {{-- BEGIN: DATA POS 6 --}}
                            <div id="dp6" class="main-activity" style="display: none;" 
                                data-pos="6" 
                                data-label="Cek certificate of analysis pelapis (vitamin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin di vitamin?</label>
                                    <select id="dp6_1" class="form-control" name="dp6_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp6_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="6" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin di vitamin?">Ada</option>
                                        <option value="0" {{ old('dp6_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="6" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada gelatin di vitamin?">Tidak ada</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 6 --}}

                            {{-- BEGIN: DATA POS 7 --}}
                            <div id="dp7" class="main-activity" style="display: none;"
                                data-pos="7"
                                data-label="Cek informasi COA gelatin (vitamin)"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor COA</label>
                                    <input type="text" class="form-control sub-activity" data-pos="7" data-label="Nomor COA" name="coa-number" placeholder="Nomor COA">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Parameter</label>
                                    <input type="text" class="form-control sub-activity" data-pos="7" data-label="Parameter" name="parameter" placeholder="Parameter">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Metode</label>
                                    <input type="text" class="form-control sub-activity" data-pos="7" data-label="Metode" name="metode" placeholder="Metode">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Hasil Uji Lab</label>
                                    <select id="dp7_1" class="form-control" name="hasil-uji-lab">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('hasil-uji-lab') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="7" data-label="Hasil Uji Lab">Terdeteksi</option>
                                        <option value="0" {{ old('hasil-uji-lab') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="7" data-label="Hasil Uji Lab">Tidak terdeteksi</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 7 --}}
                            
                            {{-- BEGIN: DATA POS 8 --}}
                            <div id="dp8" class="main-activity" style="display: none;" 
                                data-pos="8" 
                                data-label="Cek kehalalan hewan gelatin (vitamin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan hewan sumber pelapis pada vitamin?</label>
                                    <select id="dp8_1" class="form-control" name="dp8_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp8_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="8" data-label="Kehalalan hewan sumber pelapis pada vitamin?">Halal</option>
                                        <option value="Haram" {{ old('dp8_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="8" data-label="Kehalalan hewan sumber pelapis pada vitamin?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 8 --}}
                            
                            {{-- BEGIN: DATA POS 9 --}}
                            <div id="dp9" class="main-activity" style="display: none;" 
                                data-pos="9" 
                                data-label="Cek metode penyembelihan gelatin (vitamin)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?</label>
                                    <select id="dp9_1" class="form-control" name="dp9_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp9_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="9" data-label="Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?">Iya</option>
                                        <option value="0" {{ old('dp9_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="9" data-label="Apakah metode penyembelihan hewan sumber pelapis sesuai syari'at Islam?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 9 --}}
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
        let dp4 = document.querySelector('#dp4');
        let dp5 = document.querySelector('#dp5');
        let dp6 = document.querySelector('#dp6');
        let dp7 = document.querySelector('#dp7');
        let dp8 = document.querySelector('#dp8');
        let dp9 = document.querySelector('#dp9');
        let dp0_1 = document.querySelector('#dp0_1');
        let dp2_1 = document.querySelector('#dp2_1');
        let dp2_2 = document.querySelector('#dp2_2');
        let dp3_1 = document.querySelector('#dp3_1');
        let dp4_1 = document.querySelector('#dp4_1');
        let dp5_1 = document.querySelector('#dp5_1');
        let dp6_1 = document.querySelector('#dp6_1');
        let dp7_1 = document.querySelector('#dp7_1');
        let dp8_1 = document.querySelector('#dp8_1');
        let dp9_1 = document.querySelector('#dp9_1');

    </script>
    <script>
        // Display anak ke-1. Hide dan bersihkan isi anak yg lbh dari ke-1 dan cabangnya
        
        // Apakah vitamin telah bersertifikat halal?
        dp0_1.addEventListener('change', function() {
            if (dp0_1.value === "1") {
                dp1.setAttribute('data-value', 'Halal');
                displayElements(dp1);
                hideElements(dp2, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
                removeActivityValue(dp2, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
            } else if (dp0_1.value === "0"){
                displayElements(dp2);
                hideElements(dp1, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
                removeActivityValue(dp1, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
            } else {
                hideElements(dp1, dp2, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
                removeActivityValue(dp1, dp2, dp3, dp4, dp5, dp6, dp7, dp8, dp9);
            }
        });

        // Vitamin berasal dari proses mikrobial?
        dp2_1.addEventListener('change', function() {
            dp2.setAttribute('data-value', 'Syubhat');
            if (dp2_1.value === "1") {
                displayElements(dp3);
                hideElements(dp4);
                removeActivityValue(dp4);
            } else {
                hideElements(dp3, dp4);
                removeActivityValue(dp3, dp4);
            }
        });

        // Ada penggunaan bahan penyalut (coating) pada vitamin?
        dp2_2.addEventListener('change', function() {
            dp2.setAttribute('data-value', 'Syubhat');
            if (dp2_2.value === "1") {
                displayElements(dp5);
                hideElements(dp6, dp7, dp8, dp9);
                removeActivityValue(dp6, dp7, dp8, dp9);
            } else {
                hideElements(dp5, dp6, dp7, dp8, dp9);
                removeActivityValue(dp5, dp6, dp7, dp8, dp9);
            }
        });

        // Proses produksi vitamin?
        dp3_1.addEventListener('change', function() {
            if (dp3_1.value.includes("pencucian")) {
                dp3.setAttribute('data-value', 'Syubhat');
                displayElements(dp4);
            } else {
                if (dp3_1.value.includes("Tanpa")) {
                    dp3.setAttribute('data-value', 'Halal');
                }   
                hideElements(dp4);
                removeActivityValue(dp4);
            }
        });

        // Kehalalan media pertumbuhan vitamin?
        dp4_1.addEventListener('change', function() {
            if (dp4_1.value ===  "Halal") {
                dp4.setAttribute('data-value', 'Halal');
            } else if (dp4_1.value ===  "Haram") {
                dp4.setAttribute('data-value', 'Haram');
            } else {
                dp4.setAttribute('data-value', '');
            }
        });

        // Pelapis berasal dari hewan (contoh: gelatin)?
        dp5_1.addEventListener('change', function() {
            if (dp5_1.value ===  "1") {
                dp5.setAttribute('data-value', 'Syubhat');
                displayElements(dp6);
            } else {
                if (dp5_1.value === "0") {
                    dp5.setAttribute('data-value', 'Halal');
                }
                hideElements(dp6, dp7, dp8);
                removeActivityValue(dp6, dp7, dp8);
            }
        });
        
        // Apakah terdapat hasil uji lab babi
        dp6_1.addEventListener('change', function() {
            if (dp6_1.value ===  "1") {
                dp6.setAttribute('data-value', 'Syubhat');
                displayElements(dp7);
                hideElements(dp8, dp9);
                removeActivityValue(dp8, dp9);
            } else if (dp6_1.value ===  "0") {
                dp6.setAttribute('data-value', 'Syubhat');
                displayElements(dp8);
                hideElements(dp7);
                removeActivityValue(dp7);
            } else {
                dp6.setAttribute('data-value', '');
                hideElements(dp7, dp8, dp9);
                removeActivityValue(dp7, dp8, dp9);
            }
        });

        // Hasil Uji Lab babi
        dp7_1.addEventListener('change', function() {
            if (dp7_1.value ===  "0") {
                dp7.setAttribute('data-value', 'Halal');
            } else if (dp7_1.value ===  "1") {
                dp7.setAttribute('data-value', 'Haram');
            } else {
                dp7.setAttribute('data-value', '');
            }
        });

        // Kehalalan hewan sumber pelapis pada vitamin?
        dp8_1.addEventListener('change', function() {
            if (dp8_1.value ===  "Halal") {
                dp8.setAttribute('data-value', 'Halal');
                displayElements(dp9);
            } else {
                if (dp8_1.value ===  "Haram") {
                    dp8.setAttribute('data-value', 'Haram');
                }
                hideElements(dp9);
                removeActivityValue(dp9);
            }
        });

        // Apakah metode penyembelihan syar'i?
        dp9_1.addEventListener('change', function() {
            if (dp9_1.value ===  "1") {
                dp9.setAttribute('data-value', 'Halal');
            } else if (dp9_1.value ===  "0"){
                dp9.setAttribute('data-value', 'Haram');
            } else {
                dp9.setAttribute('data-value', '');
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
