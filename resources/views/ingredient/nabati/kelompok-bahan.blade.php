@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Kelompok Bahan Nabati</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek kelompok bahan" 
            data-value="Syubhat">
            Pengecekan Kelompok Bahan Nabati
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
                        {{-- BEGIN: Form --}}
                        <form id="kelompok-bahan-form" action="{{ route('nabati.kelompok-bahan.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-4">
                                <label for="regular-form-1" class="form-label">Kelompok Bahan Nabati <span class="text-danger">*</span></label>
                                <select id="kelompok-bahan-select" class="form-control" name="kelompok-bahan">
                                    @php $label = 'Kelompok Bahan Nabati'@endphp
                                    <option value="" data-info="">-- Pilih --</option>
                                    <option value="Dried products" {{ old('kelompok-bahan') == 'Dried products' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis Dried Products">Dried products</option>
                                    <option value="Tepung terigu" {{ old('kelompok-bahan') == 'Tepung terigu' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis tepung terigu">Tepung terigu</option>
                                    <option value="Oleoresin" {{ old('kelompok-bahan') == 'Oleoresin' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis oleoresin">Oleoresin</option>
                                    <option value="Emulsifier nabati" {{ old('kelompok-bahan') == 'Emulsifier nabati' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis emulsifier nabati">Emulsifier nabati</option>
                                    <option value="HVP" {{ old('kelompok-bahan') == 'HVP' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis HVP">HVP</option>
                                    <option value="Minyak nabati" {{ old('kelompok-bahan') == 'Minyak nabati' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis minyak nabati">Minyak nabati</option>
                                    <option value="Margarin" {{ old('kelompok-bahan') == 'Margarin' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis margarin">Margarin</option>
                                    <option value="Gula" {{ old('kelompok-bahan') == 'Gula' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis gula">Gula</option>
                                    <option value="Pewarna" {{ old('kelompok-bahan') == 'Pewarna' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis pewarna">Pewarna</option>
                                    <option value="Jam / Selai" {{ old('kelompok-bahan') == 'Jam / Selai' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis jam/selai">Jam / Selai</option>
                                    <option value="Manisan buah-buahan" {{ old('kelompok-bahan') == 'Manisan buah-buahan' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis manisan buah-buahan">Manisan buah-buahan</option>
                                    <option value="Sari buah & konsentrat" {{ old('kelompok-bahan') == 'Sari buah & konsentrat' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis sari buah/konsentrat">Sari buah & konsentrat</option>
                                    <option value="Buah-buahan kalengan" {{ old('kelompok-bahan') == 'Buah-buahan kalengan' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis buah-buahan kalengan">Buah-buahan kalengan</option>
                                    <option value="Saus" {{ old('kelompok-bahan') == 'Saus' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis saus">Saus</option>
                                    <option value="Pati & turunannya" {{ old('kelompok-bahan') == 'Pati & turunannya' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek bahan kritis pati dan turunannya">Pati & turunannya</option>
                                    <option value="Oplosan" {{ old('kelompok-bahan') == 'Oplosan' ? 'selected' : '' }} class="sub-activity" 
                                        data-pos="0" data-label="{{ $label }}" data-info="Cek oplosan">Oplosan</option>
                                </select>
                            </div>
                            <div id="cek-kritis" class="main-activity" style="display: none;" 
                                data-pos="1" 
                                data-label="" 
                                data-value="Syubhat">
                            </div>
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
        document.getElementById('kelompok-bahan-select').addEventListener('change', function(e) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const dataInfo = selectedOption.getAttribute('data-info');
            document.getElementById('cek-kritis').setAttribute('data-label', dataInfo);
        });
    </script>

    <script>
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let form = document.querySelector('#kelompok-bahan-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
