@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan MSG</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg mr-auto">
            Pengecekan MSG
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
                                data-label="Cek proses produksi"
                                data-value="Syubhat">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Sumber produksi mikrobial?</label>
                                    <select id="dp0_1" class="form-control" name="dp0_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tanpa pemisahan dari media pertumbuhan" {{ old('dp0_1') == "Tanpa pemisahan dari media pertumbuhan" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="0" 
                                            data-label="Sumber produksi mikrobial?">Tanpa pemisahan dari media pertumbuhan</option>
                                        <option value="Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i" {{ old('dp0_1') == "Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="0" 
                                            data-label="Sumber produksi mikrobial?">Terdapat pemisahan dari media pertumbuhan & tidak ada proses pencucian syar'i</option>
                                        <option value="Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i" {{ old('dp0_1') == "Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i" ? 'selected' : '' }} 
                                            class="sub-activity" data-pos="0" 
                                            data-label="Sumber produksi mikrobial?">Terdapat pemisahan dari media pertumbuhan & ada proses pencucian syar'i</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 0 --}}
                            
                            {{-- BEGIN: DATA POS 1 --}}
                            <div id="dp1" class="main-activity" style="display: none;" 
                                data-pos="1" 
                                data-label="Cek kehalalan media" 
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Kehalalan bahan penyusun media pertumbuhan mikroba?</label>
                                    <select id="dp1_1" class="form-control" name="dp1_1">
                                        <option value="">-- Pilih --</option>
                                        <option value="Halal" {{ old('dp1_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Kehalalan bahan penyusun media pertumbuhan mikroba?">Halal</option>
                                        <option value="Haram" {{ old('dp1_1') == "Halal" ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Kehalalan bahan penyusun media pertumbuhan mikroba?">Haram</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: DATA POS 1 --}}
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
        let dp0_1 = document.querySelector('#dp0_1');
        let dp1_1 = document.querySelector('#dp1_1');
    </script>
    <script>
        // Display anak ke-1. Hide dan bersihkan isi anak yg lbh dari ke-1 dan cabangnya

        // Cek kandungan MSG
        dp0_1.addEventListener('change', function() {
            if (dp0_1.value.includes("pencucian")) {
                dp0.setAttribute('data-value', 'Syubhat');
                displayElements(dp1);
            } else if (dp0_1.value.includes("Tanpa")) {
                dp0.setAttribute('data-value', 'Halal');
                hideElements(dp1);
                removeActivityValue(dp1);
            } else {
                dp0.setAttribute('data-value', 'Syubhat');
                hideElements(dp1);
                removeActivityValue(dp1);

            }
        });
        // Cek kehalalan media
        dp1_1.addEventListener('change', function() {
            if (dp1_1.value ===  "Halal") {
                dp1.setAttribute('data-value', 'Halal');
            } else if (dp1_1.value ===  "Haram"){
                dp1.setAttribute('data-value', 'Haram');
            } else {
                dp1.setAttribute('data-value', '');
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
