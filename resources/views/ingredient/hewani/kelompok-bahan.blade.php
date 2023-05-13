@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Kelompok Bahan Hewani</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Kelompok Bahan Hewani" 
            data-value="Syubhat">
            Pengecekan Kelompok Bahan Hewani
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
                        {{-- BEGIN: Form --}}
                        <form id="kelompok-bahan-form" action="{{ route('hewani.kelompok-bahan.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div class="mt-4">
                                <input type="hidden" class="form-control" name="ingredient_id" value="{{ $ingredient->id }}">
                                <label for="regular-form-1" class="form-label">Kelompok Bahan Hewani</label>
                                <select id="kelompok-bahan-select" class="form-control" name="kelompok-bahan">
                                    <option value="">-- Pilih --</option>
                                    <option value="sembelih" {{ old('kelompok-bahan') == 'sembelih' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Kelompok Bahan Hewani">Bahan Disembelih</option>
                                    <option value="nonsembelih" {{ old('kelompok-bahan') == 'nonsembelih' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Kelompok Bahan Hewani">Bahan Nonsembelih</option>
                                </select>
                            </div>
    
                            {{-- BEGIN: Bahan Sembelih Detail --}}
                            <div id="bahan-sembelih-detail" class="bahan-sembelih-detail main-activity" 
                                data-pos="1"
                                data-label="Cek Bahan Daging dan Turunannya"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Bahan Baku</label>
                                    <select id="bahan-baku-sembelih-select" class="form-control" name="bahan-baku-sembelih">
                                        <option value="">-- Pilih --</option>
                                        <option value="daging" {{ old('bahan-baku') == 'daging' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Daging</option>
                                        <option value="lemak" {{ old('bahan-baku') == 'lemak' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Lemak</option>
                                        <option value="kulit" {{ old('bahan-baku') == 'kulit' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Kulit</option>
                                        <option value="tulang" {{ old('bahan-baku') == 'tulang' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Tulang</option>
                                        <option value="jerohan" {{ old('bahan-baku') == 'jerohan' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Jerohan</option>
                                        <option value="darah" {{ old('bahan-baku') == 'darah' ? 'selected' : '' }} class="sub-activity" data-pos="1" data-label="Bahan Baku">Darah</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Bahan Sembelih Detail --}}
    
                            {{-- BEGIN: Bahan Nonsembelih Detail --}}
                            <div id="bahan-nonsembelih-detail" class="bahan-nonsembelih-detail main-activity" 
                                data-pos="2"
                                data-label="Cek Bahan Susu, Telur, Ikan"
                                data-value="">
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Bahan Baku</label>
                                    <select id="bahan-baku-nonsembelih-select" class="form-control" name="bahan-baku-nonsembelih">
                                        <option value="">-- Pilih --</option>
                                        <option value="susu" {{ old('bahan-baku') == 'susu' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bahan Baku">Susu</option>
                                        <option value="telur" {{ old('bahan-baku') == 'telur' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bahan Baku">Telur</option>
                                        <option value="madu" {{ old('bahan-baku') == 'madu' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bahan Baku">Madu</option>
                                        <option value="ikan" {{ old('bahan-baku') == 'ikan' ? 'selected' : '' }} class="sub-activity" data-pos="2" data-label="Bahan Baku">Ikan</option>
                                    </select>
                                </div>
                            </div>
                            {{-- END: Bahan Nonsembelih Detail --}} 
                        </form>
                        {{-- END: Form --}}
                        <div id="mover-container" class="mt-5">
                            <a href="{{ route('product.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
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
        // Display Certificate Detail if isNotBabiCertified 
        // Get a reference to the select element and the bahan-sembelih-detail div
        let kelompokBahanSelectEl = document.querySelector('#kelompok-bahan-select');
        let bahanSembelihDetailEl = document.querySelector('#bahan-sembelih-detail');
        let bahanNonsembelihDetailEl = document.querySelector('#bahan-nonsembelih-detail');
        
        kelompokBahanSelectEl.addEventListener('change', function() {
            if (kelompokBahanSelectEl.value === "sembelih") {
                bahanSembelihDetailEl.style.display = 'block';
                bahanSembelihDetailEl.setAttribute('data-value', 'Syubhat');
                
                bahanNonsembelihDetailEl.style.display = 'none';
                removeActivityValue(bahanNonsembelihDetailEl)
            } else if (kelompokBahanSelectEl.value === "nonsembelih") {
                bahanNonsembelihDetailEl.style.display = 'block';
                bahanNonsembelihDetailEl.setAttribute('data-value', 'Syubhat');
                
                bahanSembelihDetailEl.style.display = 'none';
                removeActivityValue(bahanSembelihDetailEl)
            } else {
                bahanSembelihDetailEl.style.display = 'none';
                bahanNonsembelihDetailEl.style.display = 'none';
                removeActivityValue(bahanSembelihDetailEl)
                removeActivityValue(bahanNonsembelihDetailEl)
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        kelompokBahanSelectEl.dispatchEvent(new Event('change'));
    </script>
    
    <script>
        // Process Activity if isNotBabiCertified
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let form = document.querySelector('#kelompok-bahan-form');
            form.submit(); 
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
