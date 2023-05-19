@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Pengolahan Bahan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos="0" 
            data-label="Cek Pengolahan" 
            data-value="Syubhat">
            Pengecekan Pengolahan Bahan
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
                        <form id="tambahan-form" action="{{ route('hewani.pengolahan-tambahan', ['ingredient_id' => $ingredient->id])}}" method="GET">
                            <div class="mt-3">
                                <input type="hidden" class="form-control" name="ingredient_id" value="{{ $ingredient->id }}">
                                <label for="regular-form-1" class="form-label">Apakah terdapat pengolahan pada bahan?</label>
                                <select id="is-ada-tambahan-select" class="form-control" name="is-ada-tambahan">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('is-ada-tambahan') == '1' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat pengolahan pada bahan?">Iya</option>
                                    <option value="0" {{ old('is-ada-tambahan') == '0' ? 'selected' : '' }} class="sub-activity" data-pos="0" data-label="Apakah terdapat pengolahan pada bahan?">Tidak</option>
                                </select>
                            </div>

                            {{-- BEGIN: Tambahan Detail --}}
                            <div id="tambahan-detail" class="tambahan-activity" 
                                data-pos='1' 
                                data-value="">
                                <div class="mt-4">
                                    {{-- checkbox --}}
                                    <label for="regular-form-1" class="form-label">CHECKBOX 1</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama RPH" placeholder="Nama RPH">
                                </div>
                                <div class="mt-3">
                                    {{-- checkbox --}}
                                    <label for="regular-form-1" class="form-label">CHECKBOX 2</label>
                                    <input type="text" class="form-control sub-activity" data-pos="1" data-label="Nama RPH" placeholder="Nama RPH">
                                </div>
                            </div>
                            {{-- END: Tambahan Detail --}}

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
        let tambahanDetailEl = document.querySelector('#tambahan-detail');
        let isAdaTambahanSelectEl = document.querySelector('#is-ada-tambahan-select');

        isAdaTambahanSelectEl.addEventListener('change', function() {
            if (isAdaTambahanSelectEl.value === "1") {
                tambahanDetailEl.style.display = 'block';
                mainHeaderEl.setAttribute('data-value', 'Syubhat')
            } else if (isAdaTambahanSelectEl.value === "0"){
                tambahanDetailEl.style.display = 'none';
                mainHeaderEl.setAttribute('data-value', 'Halal')
                removeActivityValue(tambahanDetailEl)
            } else {
                tambahanDetailEl.style.display = 'none';
                mainHeaderEl.setAttribute('data-value', '')
                removeActivityValue(tambahanDetailEl)
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        isAdaTambahanSelectEl.dispatchEvent(new Event('change'));
    </script>
    
    <script>
        document.getElementById('right-btn').addEventListener('click', function(e) {

        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
