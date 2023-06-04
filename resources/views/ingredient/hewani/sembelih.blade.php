@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Proses Penyembelihan Hewan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Penyembelihan" 
            data-value="Syubhat">
            Pengecekan Proses Penyembelihan Hewan
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
                        <form id="sembelih-form" action="{{ route('hewani.pengolahan-tambahan', ['ingredient_id' => $ingredient->id, 'bahan-baku' => $bahanBaku]) }}" method="GET">
                            <div class="mt-3">
                                <input id="kehalalan-bahan" type="hidden" class="form-control" name="kehalalan-bahan" value="Syubhat">
                                <label for="regular-form-1" class="form-label">Apakah bahan berasal dari rumah potong bersertifikat halal? <span class="text-danger">*</span></label>
                                <select id="is-rumah-halal-select" class="form-control" name="is-rumah-halal">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('is-rumah-halal') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah bahan berasal dari rumah potong bersertifikat halal?">Iya</option>
                                    <option value="0" {{ old('is-rumah-halal') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah bahan berasal dari rumah potong bersertifikat halal?">Tidak</option>
                                </select>
                            </div>

                            {{-- BEGIN: Certificate Detail --}}
                            <div id="certificate-detail" class="main-activity" 
                                data-pos='1' 
                                data-label="Cek Informasi Sertifikat RPH" 
                                data-value="">
                                <h2 class="mt-4"><b>-- Detail Rumah Pemotongan Hewan (RPH)  --</b></h2>
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nama Rumah Pemotongan Hewan (RPH)</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama RPH" name="nama-rph" placeholder="Nama RPH">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Alamat Rumah Pemotongan Hewan (RPH)</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Alamat" name="alamat-rph" placeholder="Alamat RPH">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos='1' data-label="Nomor Sertifikat" name="nomor-sertifikat-rph" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos='1' data-label="Lembaga Penerbit Sertifikat" name="penerbit-rph" placeholder="Lembaga Penerbit Sertifikat">
                                </div>
                                <div style="display: flex; flex-wrap: wrap;" class="mt-1">
                                    <div class="mt-3">
                                        <label for="regular-form-1" class="form-label">Mulai Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos='1' data-label="Mulai Masa Berlaku" name="mulai-berlaku-rph" placeholder="Mulai Masa Berlaku">
                                    </div>
                                    <div class="mt-3 ml-5">
                                        <label for="regular-form-1" class="form-label">Akhir Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos='1' data-label="Akhir Masa Berlaku" name="akhir-berlaku-rph" placeholder="Akhir Masa Berlaku">
                                    </div>
                                </div>
                            </div>
                            {{-- END: Certificate Detail --}}

                            {{-- BEGIN: Cek RPH --}}
                            <div id="rph-detail" class="main-activity" 
                                data-pos="2"
                                data-label="Cek RPH"
                                data-value="">
                                <h2 class="mt-4"><b>-- Cek Penyembelih --</b></h2>
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nama Rumah Pemotongan Hewan (RPH)</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Nama RPH" name="nama-rph" placeholder="Nama RPH">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Alamat Rumah Pemotongan Hewan (RPH)</label>
                                    <input type="text" class="form-control sub-activity" data-pos="2" data-label="Alamat" name="alamat-rph" placeholder="Alamat RPH">
                                </div>
                                <div id="agama-penyembelih" class="mt-3 rph-activity" data-value="">
                                    <label for="regular-form-1" class="form-label">Agama Penyembelih</label>
                                    <select id="agama-penyembelih-select" class="form-control" name="agama-penyembelih">
                                        <option value="">-- Pilih --</option>
                                        <option value="islam" {{ old('agama-penyembelih') == 'islam' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Agama Penyembelih">Islam</option>
                                        <option value="nonislam" {{ old('agama-penyembelih') == 'nonislam' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Agama Penyembelih">Nonislam</option>
                                    </select>
                                </div>
                                <div id="usia-penyembelih" class="mt-3 rph-activity" data-value="">
                                    <label for="regular-form-1" class="form-label">Usia Penyembelih</label>
                                    <select id="usia-penyembelih-select" class="form-control" name="usia-penyembelih">
                                        <option value="">-- Pilih --</option>
                                        <option value="baligh" {{ old('usia-penyembelih') == 'baligh' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Usia Penyembelih">Sudah baligh</option>
                                        <option value="belum-baligh" {{ old('usia-penyembelih') == 'belum-baligh' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Usia Penyembelih">Belum baligh</option>
                                    </select>
                                </div>
                                
                                <h2 class="mt-4"><b>-- Cek Metode Penyembelihan --</b></h2>
                                <div id="metode-penyembelihan" class="mt-3 rph-activity" data-value="">
                                    <label for="regular-form-1" class="form-label">Metode</label>
                                    <select id="metode-penyembelihan-select" class="form-control" name="metode-penyembelihan">
                                        <option value="">-- Pilih --</option>
                                        <option value="tanpa-pingsan" {{ old('metode-penyembelihan') == 'tanpa-pingsan' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Metode Penyembelihan">Tanpa pemingsanan</option>
                                        <option value="pingsan" {{ old('metode-penyembelihan') == 'pingsan' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Metode Penyembelihan">Dengan pemingsanan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Cek RPH --}}
                        </form>
                        <!-- END: Form -->
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

    @include('../layout/components/processing-script')

    {{-- BEGIN: Additional Scripts --}}
    <script>
        let mainHeaderEl = document.querySelector('#main-header');
        let certificateDetailEl = document.querySelector('#certificate-detail');
        let rphDetailEl = document.querySelector('#rph-detail');
        let agamaPenyembelihEl = document.querySelector('#agama-penyembelih');
        let usiaPenyembelihEl = document.querySelector('#usia-penyembelih');
        let metodePenyembelihanEl = document.querySelector('#metode-penyembelihan');
        let kehalalanBahanEl = document.querySelector('#kehalalan-bahan');
        
        let isRumahHalalSelectEl = document.querySelector('#is-rumah-halal-select');
        let agamaPenyembelihSelectEl = document.querySelector('#agama-penyembelih-select');
        let usiaPenyembelihSelectEl = document.querySelector('#usia-penyembelih-select');
        let metodePenyembelihanSelectEl = document.querySelector('#metode-penyembelihan-select');

        
        isRumahHalalSelectEl.addEventListener('change', function() {
            if (isRumahHalalSelectEl.value === "1") {
                certificateDetailEl.style.display = 'block';
                rphDetailEl.style.display = 'none';
                certificateDetailEl.setAttribute('data-value', 'Halal')
                mainHeaderEl.setAttribute('data-value', 'Halal')
                kehalalanBahanEl.value = 'Halal';
                
                removeActivityValue(rphDetailEl)
            } else if (isRumahHalalSelectEl.value === "0"){
                rphDetailEl.style.display = 'block';
                certificateDetailEl.style.display = 'none';
                mainHeaderEl.setAttribute('data-value', 'Syubhat')
                kehalalanBahanEl.value = 'Syubhat'
                
                removeActivityValue(certificateDetailEl)
            } else {
                certificateDetailEl.style.display = 'none';
                rphDetailEl.style.display = 'none';
                mainHeaderEl.setAttribute('data-value', 'Syubhat')
                kehalalanBahanEl.value = 'Syubhat'

                removeActivityValue(certificateDetailEl)
                removeActivityValue(rphDetailEl)
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        isRumahHalalSelectEl.dispatchEvent(new Event('change'));
    </script>

    <script>
        function updateRPHDetailDataValue() {
            let rphActivityElems = document.querySelectorAll('.rph-activity');
            let kehalalanBahanEl = document.querySelector('#kehalalan-bahan');
            let nHalalEl = 0;
            let nSyubhatEl = 0;
            
            rphDetailEl.setAttribute('data-value', 'Syubhat')            
            for (let i = 0; i < rphActivityElems.length; i++) {
                let val = rphActivityElems[i].getAttribute('data-value');
                if (val === 'Haram') {
                    rphDetailEl.setAttribute('data-value', 'Haram');
                    break;
                } 
                if (val === 'Syubhat') {
                    nSyubhatEl++;
                }
                if (val === 'Halal') {
                    nHalalEl++;
                }
            }

            if (nHalalEl > 0 && nSyubhatEl === 0) {
                rphDetailEl.setAttribute('data-value', 'Halal');
            }
            
            kehalalanBahanEl.value = rphDetailEl.getAttribute('data-value');
        }

        agamaPenyembelihSelectEl.addEventListener('change', function() {
            if (agamaPenyembelihSelectEl.value === "nonislam") {
                agamaPenyembelihEl.setAttribute('data-value', 'Haram');
            } else if (agamaPenyembelihSelectEl.value === "") {
                agamaPenyembelihEl.setAttribute('data-value', '');
            } else {
                agamaPenyembelihEl.setAttribute('data-value', 'Halal');
            }
            updateRPHDetailDataValue();
        });

        usiaPenyembelihSelectEl.addEventListener('change', function() {
            if (usiaPenyembelihSelectEl.value === "belum-baligh") {
                usiaPenyembelihEl.setAttribute('data-value', 'Haram');
            } else if (usiaPenyembelihSelectEl.value === "") {
                usiaPenyembelihEl.setAttribute('data-value', '');
            } else {
                usiaPenyembelihEl.setAttribute('data-value', 'Halal');
            }
            updateRPHDetailDataValue();
        });

        metodePenyembelihanSelectEl.addEventListener('change', function() {
            if (metodePenyembelihanSelectEl.value === "pingsan") {
                metodePenyembelihanEl.setAttribute('data-value', 'Syubhat');
            } else if (metodePenyembelihanSelectEl.value === "") {
                metodePenyembelihanEl.setAttribute('data-value', '');
            } else {
                metodePenyembelihanEl.setAttribute('data-value', 'Halal');
            }
            updateRPHDetailDataValue();
        });
    </script>
    
    <script>
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            let kehalalanBahanEl = await document.querySelector('#kehalalan-bahan');
            if (kehalalanBahanEl.value === 'Haram') {
                await processActivity('{{ csrf_token() }}', 'rule');
            } else {
                let form = document.querySelector('#sembelih-form');
                window.location.href = form.action;
            }
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
