@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Hasil Uji Laboratorium</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Certificate Analysis" 
            data-value="Syubhat">
            Pengecekan Hasil Uji Laboratorium
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
                        <form id="is-not-babi-certified-form" action="{{ route('hewani.kelompok-bahan', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="ingredient-id" value="{{ $ingredient->id }}">
                                <label for="regular-form-1" class="form-label">Apakah terdapat hasil uji lab kandungan DNA babi pada bahan? <span class="text-danger">*</span></label>
                                <select id="is-not-babi-certified-select" class="form-control" name="is-not-babi-certified">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('is-not-babi-certified') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada bahan?">Ada</option>
                                    <option value="0" {{ old('is-not-babi-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat hasil uji lab kandungan DNA babi pada bahan?">Tidak ada</option>
                                </select>
                            </div>
                            {{-- BEGIN: Uji Babi Detail --}}
                            <div id="uji-babi-detail" class="uji-babi-detail main-activity" 
                                data-pos="1"
                                data-label="Cek COA DNA Babi"
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
                                    <label for="regular-form-1" class="form-label">Hasil Uji Lab <span class="text-danger">*</span></label>
                                    <select id="hasil-uji-lab-select" class="form-control" name="hasil-uji-lab">
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('hasil-uji-lab') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Hasil Uji Lab">Terdeteksi</option>
                                        <option value="0" {{ old('hasil-uji-lab') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Hasil Uji Lab">Tidak terdeteksi</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Uji Babi Detail --}}
                        </form>
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
        let isCertifiedSelectEl = document.querySelector('#is-not-babi-certified-select');
        let ujiBabiDetailEl = document.querySelector('#uji-babi-detail');
        let HasilUjiBabiSelectEl = document.querySelector('#hasil-uji-lab-select');
        
        isCertifiedSelectEl.addEventListener('change', function() {
            if (isCertifiedSelectEl.value === "1") {
                displayElements(ujiBabiDetailEl);
            } else {
                hideElements(ujiBabiDetailEl);
                removeActivityValue(ujiBabiDetailEl)
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

        // Call the event listener once on page load to set the initial state of the div
        isCertifiedSelectEl.dispatchEvent(new Event('change'));
        HasilUjiBabiSelectEl.dispatchEvent(new Event('change'));
    </script>
    
    <script>
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            let selectEl = document.querySelector('#is-not-babi-certified-select');
            let select2El = document.querySelector('#hasil-uji-lab-select');
            if (selectEl.value === "1" && select2El.value === '') {
                alert('Hasil Uji Lab wajib diisi');
            } else if (selectEl.value === "1" && select2El.value !== '') {
                await processActivity('{{ csrf_token() }}', 'rule');
            } else {
                let form = document.querySelector('#is-not-babi-certified-form');
                form.submit();
            }
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
