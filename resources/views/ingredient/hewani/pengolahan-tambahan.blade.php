@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Pengolahan Bahan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
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
                                    <option value="1" {{ old('is-ada-tambahan') == '1' ? 'selected' : '' }} class="sub-activity" data-label="Apakah terdapat pengolahan pada bahan?">Iya</option>
                                    <option value="0" {{ old('is-ada-tambahan') == '0' ? 'selected' : '' }} class="sub-activity" data-label="Apakah terdapat pengolahan pada bahan?">Tidak</option>
                                </select>
                            </div>

                            {{-- BEGIN: Tambahan Detail --}}
                            <div id="tambahan-detail" class="tambahan-activity">
                                <h2 class="mt-4"><b>-- Pilih Bahan Tambahan Pangan (BTP) pada Bahan --</b></h2>
                                <div class="mt-4" id="list-bahan-tambahan">
                                    <input id="list-btp" type="hidden" class="form-control sub-activity" data-label="Daftar Bahan Tambahan Pangan pada Bahan">
                                    
                                    <input id="checkbox-1" class="form-check-input mr-0 ml-3" data-label="Garam" data-value="Garam" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Garam</label>

                                    <input id="checkbox-2" class="form-check-input mr-0 ml-3" data-label="Gula" data-value="Gula" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Gula</label>
                                    
                                    <input id="checkbox-3" class="form-check-input mr-0 ml-3" data-label="Flavor" data-value="Flavor" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Flavor</label>
                                    
                                    <input id="checkbox-4" class="form-check-input mr-0 ml-3" data-label="Pewarna" data-value="Pewarna" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Pewarna</label>

                                    <input id="checkbox-5" class="form-check-input mr-0 ml-3" data-label="Penyedap" data-value="Penyedap" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Penyedap Rasa</label>

                                    <input id="checkbox-6" class="form-check-input mr-0 ml-3" data-label="Emulsifier" data-value="Emulsifier" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Emulsifier</label>

                                    <input id="checkbox-7" class="form-check-input mr-0 ml-3" data-label="Pengawet" data-value="Pengawet" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">Pengawet</label>

                                    <input id="checkbox-8" class="form-check-input mr-0 ml-3" data-label="BTP Lainnya" data-value="BTP Lainnya" type="checkbox">
                                    <label class="form-check-label ml-0" for="show-example-1">BTP Lainnya</label>
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
        let listBtpEl = document.querySelector('#list-btp');

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
        const checkboxes = document.querySelectorAll('#tambahan-detail input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {                
                let listBTP = [];
                const items = document.querySelectorAll('#tambahan-detail input[type="checkbox"]:checked');
                items.forEach(function(item) {
                    listBTP.push(item.getAttribute('data-value'));
                });
                listBtpEl.value = String(listBTP);
            });
        });
    </script>
    
    <script>
        document.getElementById('right-btn').addEventListener('click', function(e) {
            const checkedBTP = listBtpEl.value;
            const arrayBTP = checkedBTP.split(',');
            sessionStorage.setItem('tambahan-hewani', JSON.stringify(arrayBTP));
            // Go to related all btp pages
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
