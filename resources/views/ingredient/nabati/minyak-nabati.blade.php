@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Minyak Nabati</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg mr-auto">
            Pengecekan Minyak Nabati
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
                                data-label="Cek sumber karbon aktif (minyak nabati)" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label font-medium">Sumber karbon aktif pada minyak nabati?</label>
                                    <select id="dp0_1" class="form-control" name="dp0_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tumbuhan" {{ old('dp0_1') == "Tumbuhan" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Sumber karbon aktif pada minyak nabati?">Tumbuhan</option>
                                        <option value="Bahan tambang" {{ old('dp0_1') == "Bahan tambang" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Sumber karbon aktif pada minyak nabati?">Bahan tambang</option>
                                        <option value="Hewan" {{ old('dp0_1') == "Hewan" ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Sumber karbon aktif pada minyak nabati?">Hewan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 0 --}}
                         
                            {{-- BEGIN: DATA POS 1 --}}
                            <div id="dp1" class="main-activity" style="display: none;" 
                                data-pos="1" 
                                data-label="Cek sertifikat halal minyak nabati" 
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah minyak nabati telah bersertifikat halal?</label>
                                    <select id="dp1_1" class="form-control" name="dp1_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp1_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah minyak nabati telah bersertifikat halal?">Iya</option>
                                        <option value="0" {{ old('dp1_1') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Apakah minyak nabati telah bersertifikat halal?">Belum</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 1 --}}
                            
                            {{-- BEGIN: DATA POS 2 --}}
                            <div id="dp2" class="main-activity" style="display: none;" 
                                data-pos="2" 
                                data-label="Cek informasi SH minyak nabati" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Nomor Sertifikat" name="certificate-number" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Lembaga Penerbit Sertifikat" name="certificate-institution" placeholder="Lembaga Penerbit Sertifikat">
                                </div>
                                <div style="display: flex; flex-wrap: wrap;" class="mt-1">
                                    <div class="mt-3">
                                        <label for="regular-form-1" class="form-label">Akhir Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos="2" data-label="Akhir Masa Berlaku" name="certificate-end-date" placeholder="Akhir Masa Berlaku">
                                    </div>
                                </div>
                            </div>
                            {{-- END: DATA POS 2 --}}
                            
                            {{-- BEGIN: DATA POS 3 --}}
                            <div id="dp3" class="main-activity" style="display: none;" 
                                data-pos="3" 
                                data-label="Cek kehalalan hewan (minyak nabati)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan hewan sumber karbon aktif pada minyak nabati?</label>
                                    <select id="dp3_1" class="form-control" name="dp3_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp3_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Kehalalan hewan sumber karbon aktif pada minyak nabati?">Halal</option>
                                        <option value="Haram" {{ old('dp3_1') == "Haram" ? 'selected' : '' }} class="sub-activity" data-pos="3" data-label="Kehalalan hewan sumber karbon aktif pada minyak nabati?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 3 --}}
                            
                            {{-- BEGIN: DATA POS 4 --}}
                            <div id="dp4" class="main-activity" style="display: none;" 
                                data-pos="4" 
                                data-label="Cek metode penyembelihan (minyak nabati)" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Apakah metode penyembelihan hewan sumber karbon aktif pada minyak nabati sesuai syari'at Islam?</label>
                                    <select id="dp4_1" class="form-control" name="dp4_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('dp4_1') == "1" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Apakah metode penyembelihan hewan sumber karbon aktif pada minyak nabati sesuai syari'at Islam?">Iya</option>
                                        <option value="0" {{ old('dp4_1') == "0" ? 'selected' : '' }} class="sub-activity" data-pos="4" data-label="Apakah metode penyembelihan hewan sumber karbon aktif pada minyak nabati sesuai syari'at Islam?">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 4 --}}
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
        let dp0_1 = document.querySelector('#dp0_1');
        let dp1_1 = document.querySelector('#dp1_1');
        let dp3_1 = document.querySelector('#dp3_1');
        let dp4_1 = document.querySelector('#dp4_1');

    </script>
    <script>
        // Display anak ke-1. Hide dan bersihkan isi anak yg lbh dari ke-1 dan cabangnya
        
        // Sumber karbon aktif pada minyak nabati?
        dp0_1.addEventListener('change', function() {
            if (dp0_1.value === "Tumbuhan" || dp0_1.value === "Bahan tambang") {
                dp0.setAttribute('data-value', 'Halal');
                hideElements(dp1, dp2, dp3, dp4);
                removeActivityValue(dp1, dp2, dp3, dp4);
            } else if (dp0_1.value === "Hewan") {
                dp0.setAttribute('data-value', 'Syubhat');
                displayElements(dp1);
                hideElements(dp2, dp3, dp4);
                removeActivityValue(dp2, dp3, dp4);
            } else {
                dp0.setAttribute('data-value', 'Syubhat');
                hideElements(dp1, dp2, dp3, dp4);
                removeActivityValue(dp1, dp2, dp3, dp4);
            }
        });
        
        // Apakah minyak nabati telah bersertifikat halal?
        dp1_1.addEventListener('change', function() {
            if (dp1_1.value === "1") {
                dp1.setAttribute('data-value', 'Syubhat');
                dp2.setAttribute('data-value', 'Halal');
                displayElements(dp2);
                hideElements(dp3, dp4);
                removeActivityValue(dp3, dp4);
            } else if (dp1_1.value === "0"){
                dp1.setAttribute('data-value', 'Syubhat');
                displayElements(dp3);
                hideElements(dp2, dp4);
                removeActivityValue(dp2, dp4);
            } else {
                dp1.setAttribute('data-value', '');
                hideElements(dp2, dp3, dp4);
                removeActivityValue(dp2, dp3, dp4);
            }
        });

        // Kehalalan hewan pada minyak nabati?
        dp3_1.addEventListener('change', function() {
            if (dp3_1.value ===  "Halal") {
                dp3.setAttribute('data-value', 'Halal');
                displayElements(dp4);
            } else {
                if (dp3_1.value ===  "Haram") {
                    dp3.setAttribute('data-value', 'Haram');
                }
                hideElements(dp4);
                removeActivityValue(dp4);
            }
        });

        // Apakah metode penyembelihan syar'i?
        dp4_1.addEventListener('change', function() {
            if (dp4_1.value ===  "1") {
                dp4.setAttribute('data-value', 'Halal');
            } else if (dp4_1.value ===  "0"){
                dp4.setAttribute('data-value', 'Haram');
            } else {
                dp4.setAttribute('data-value', '');
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
