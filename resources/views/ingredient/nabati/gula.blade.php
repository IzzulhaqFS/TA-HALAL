@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Gula</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg mr-auto">
            Pengecekan Gula
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
                                data-label="Cek kandungan gula" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label font-medium">Ada penggunaan karbon/arang aktif pada proses pemurnian?</label>
                                    <select id="dp0_1" class="form-control" name="dp0_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp0_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Ada penggunaan karbon/arang aktif pada proses pemurnian?">Iya</option>
                                        <option value="0" {{ old('dp0_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Ada penggunaan karbon/arang aktif pada proses pemurnian?">Tidak</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label font-medium">Ada penggunaan resin pada proses pemurnian?</label>
                                    <select id="dp0_2" class="form-control" name="dp0_2">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp0_2') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Ada penggunaan resin pada proses pemurnian?">Iya</option>
                                        <option value="0" {{ old('dp0_2') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Ada penggunaan resin pada proses pemurnian?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 0 --}}
                            
                            {{-- BEGIN: DATA POS 1 --}}
                            <div id="dp1" class="main-activity" style="display: none;" 
                                data-pos="1" 
                                data-label="Cek sumber karbon aktif (gula)" 
                                data-value="">
                                <hr class="mt-6" style="border-top-width: 2px">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Sumber karbon aktif pada gula?</label>
                                    <select id="dp1_1" class="form-control" name="dp1_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tumbuhan" {{ old('dp1_1') == "Tumbuhan" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Sumber karbon aktif pada gula?">Tumbuhan</option>
                                        <option value="Bahan tambang" {{ old('dp1_1') == "Bahan tambang" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Sumber karbon aktif pada gula?">Bahan tambang</option>
                                        <option value="Hewan" {{ old('dp1_1') == "Hewan" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Sumber karbon aktif pada gula?">Hewan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 1 --}}
                            
                            {{-- BEGIN: DATA POS 2 --}}
                            <div id="dp2" class="main-activity" style="display: none;" 
                                data-pos="2" 
                                data-label="Cek kehalalan hewan karbon aktif (gula)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan hewan sumber karbon aktif pada gula?</label>
                                    <select id="dp2_1" class="form-control" name="dp2_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp2_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Kehalalan hewan sumber karbon aktif pada gula?">Halal</option>
                                        <option value="Haram" {{ old('dp2_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Kehalalan hewan sumber karbon aktif pada gula?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 2 --}}
                            
                            {{-- BEGIN: DATA POS 3 --}}
                            <div id="dp3" class="main-activity" style="display: none;" 
                                data-pos="3" 
                                data-label="Cek metode penyembelihan karbon aktif (gula)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah metode penyembelihan hewan sumber karbon aktif pada gula sesuai syari'at Islam?</label>
                                    <select id="dp3_1" class="form-control" name="dp3_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp3_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Apakah metode penyembelihan hewan sumber karbon aktif pada gula sesuai syari'at Islam?">Iya</option>
                                        <option value="0" {{ old('dp3_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Apakah metode penyembelihan hewan sumber karbon aktif pada gula sesuai syari'at Islam?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 3 --}}

                            {{-- BEGIN: DATA POS 4 --}}
                            <div id="dp4" class="main-activity" style="display: none;" 
                                data-pos="4" 
                                data-label="Cek kandungan resin (gula)" 
                                data-value="">
                                <hr class="mt-6" style="border-top-width: 2px">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Ada penggunaan gelatin pada pembuatan resin?</label>
                                    <select id="dp4_1" class="form-control" name="dp4_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp4_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Ada penggunaan gelatin pada pembuatan resin?">Iya</option>
                                        <option value="0" {{ old('dp4_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Ada penggunaan gelatin pada pembuatan resin?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 4 --}}
                            
                            {{-- BEGIN: DATA POS 5 --}}
                            <div id="dp5" class="main-activity" style="display: none;" 
                                data-pos="5" 
                                data-label="Cek kehalalan hewan resin (gula)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan hewan pada proses pembuatan resin pada gula?</label>
                                    <select id="dp5_1" class="form-control" name="dp5_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp5_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="5" data-label="Kehalalan hewan pada proses pembuatan resin pada gula?">Halal</option>
                                        <option value="Haram" {{ old('dp5_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="5" data-label="Kehalalan hewan pada proses pembuatan resin pada gula?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 5 --}}
                            
                            {{-- BEGIN: DATA POS 6 --}}
                            <div id="dp6" class="main-activity" style="display: none;" 
                                data-pos="6" 
                                data-label="Cek metode penyembelihan resin (gula)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah metode penyembelihan hewan pada proses pembuatan resin sesuai syari'at Islam?</label>
                                    <select id="dp6_1" class="form-control" name="dp6_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp6_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="6" data-label="Apakah metode penyembelihan hewan pada proses pembuatan resin sesuai syari'at Islam?">Iya</option>
                                        <option value="0" {{ old('dp6_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="6" data-label="Apakah metode penyembelihan hewan pada proses pembuatan resin sesuai syari'at Islam?">Tidak</option>
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
        let dp4 = document.querySelector('#dp4');
        let dp5 = document.querySelector('#dp5');
        let dp6 = document.querySelector('#dp6');
        let dp0_1 = document.querySelector('#dp0_1');
        let dp0_2 = document.querySelector('#dp0_2');
        let dp2_1 = document.querySelector('#dp2_1');
        let dp3_1 = document.querySelector('#dp3_1');
        let dp4_1 = document.querySelector('#dp4_1');
        let dp5_1 = document.querySelector('#dp5_1');
        let dp6_1 = document.querySelector('#dp6_1');

    </script>
    <script>
        // Display anak ke-1. Hide dan bersihkan isi anak yg lbh dari ke-1 dan cabangnya
        
        // Cek kandungan gula
        dp0_1.addEventListener('change', function() {
            if (dp0_1.value === "1") {
                displayElements(dp1);
                hideElements(dp2, dp3);
                removeActivityValue(dp2, dp3);
            } else {
                hideElements(dp1, dp2, dp3);
                removeActivityValue(dp1, dp2, dp3);
            }
        });

        dp0_2.addEventListener('change', function() {
            if (dp0_2.value === "1") {
                displayElements(dp4);
                hideElements(dp5, dp6);
                removeActivityValue(dp5, dp6);
            } else {
                hideElements(dp4, dp5, dp6);
                removeActivityValue(dp4, dp5, dp6);
            }
        });

        // Cek sumber karbon aktif (gula)
        dp1_1.addEventListener('change', function() {
            if (dp1_1.value === "Tumbuhan" || dp1_1.value === "Bahan tambang") {
                dp1.setAttribute('data-value', 'Halal');
                hideElements(dp2, dp3);
                removeActivityValue(dp2, dp3);
            } else if (dp1_1.value === "Hewan") {
                dp1.setAttribute('data-value', 'Syubhat');
                displayElements(dp2);
                hideElements(dp3);
                removeActivityValue(dp3);
            } else {
                dp1.setAttribute('data-value', '');
                hideElements(dp2, dp3);
                removeActivityValue(dp2, dp3);
            }
        });


        // Cek kehalalan hewan karbon aktif (gula)
        dp2_1.addEventListener('change', function() {
            if (dp2_1.value === 'Halal') {
                dp2.setAttribute('data-value', 'Halal');
                displayElements(dp3);
            } else {
                if (dp2_1.value === 'Haram') {
                    dp2.setAttribute('data-value', 'Haram');
                }
                hideElements(dp3);
                removeActivityValue(dp3);
            }
        });

        // Cek metode penyembelihan karbon aktif (gula)
        dp3_1.addEventListener('change', function() {
            if (dp3_1.value === '1') {
                dp3.setAttribute('data-value', 'Halal');
            } else if (dp3_1.value === '0') {
                dp3.setAttribute('data-value', 'Haram');
            } else {
                dp3.setAttribute('data-value', '');
            }
        });

        // Cek kandungan resin (gula)
        dp4_1.addEventListener('change', function() {
            if (dp4_1.value === '1') {
                dp4.setAttribute('data-value', 'Syubhat');
                displayElements(dp5);
            } else if (dp4_1.value === '0') {
                dp4.setAttribute('data-value', 'Halal');
                hideElements(dp5, dp6);
                removeActivityValue(dp5, dp6);
            } else {
                dp4.setAttribute('data-value', '');
                hideElements(dp5, dp6);
                removeActivityValue(dp5, dp6);
            }
        });

        // Cek kehalalan hewan resin (gula)
        dp5_1.addEventListener('change', function() {
            if (dp5_1.value ===  "Halal") {
                dp5.setAttribute('data-value', 'Halal');
                displayElements(dp6);
            } else {
                if (dp5_1.value === "Haram") {
                    dp5.setAttribute('data-value', 'Haram');
                }
                hideElements(dp6);
                removeActivityValue(dp6);
            }
        });
        
        // Cek metode penyembelihan resin (gula)
        dp6_1.addEventListener('change', function() {
            if (dp6_1.value ===  "Halal") {
                dp6.setAttribute('data-value', 'Halal');
            } else if (dp6_1.value === "Haram") {
                dp6.setAttribute('data-value', 'Haram');
            } else {
                dp6.setAttribute('data-value', '');
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        dp0_1.dispatchEvent(new Event('change'));
    </script>


    {{-- Jika sudah di hal akhir bahan kritis --}}
    @if (count(explode(",", $listBahanKritis)) == ($index + 1))
    <script>
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
