@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Titik Kritis Bahan {{ $kelompokBahan }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto">
            Pengecekan Titik Kritis Bahan {{ $kelompokBahan }}
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
                        <form id="potensi-bahan-kritis-form" action="{{ route('nabati.potensi-bahan-kritis.process', ['ingredient_id' => $ingredient->id]) }}" method="GET">
                            <div id="potensi-bahan-kritis-detail">
                                <h2 class="mt-4"><b>-- Pilih bahan kritis yang digunakan pada bahan --</b></h2>
                                <div class="mt-4" id="list-potensi-bahan-kritis">
                                    <input id="kelompok-bahan" type="hidden" class="form-control" name="kelompok-bahan" value="{{ $kelompokBahan }}">
                                    <input id="bahan-kritis" type="hidden" class="form-control" name="bahan-kritis">
                                    
                                    @foreach ($titikKritis as $bahan)
                                        <input id="checkbox-1" class="form-check-input mr-0 ml-3" data-value="{{ $bahan }}" type="checkbox">
                                        <label class="form-check-label ml-0" for="show-example-1">{{ str_replace('-', ' ', ucfirst($bahan)) }}</label>
                                    @endforeach

                                </div>
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
        let bahanKritisEl = document.querySelector('#bahan-kritis');
        const checkboxes = document.querySelectorAll('#potensi-bahan-kritis-detail input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {                
                let bahanKritis = [];
                const items = document.querySelectorAll('#potensi-bahan-kritis-detail input[type="checkbox"]:checked');
                items.forEach(function(item) {
                    bahanKritis.push(item.getAttribute('data-value'));
                });
                bahanKritisEl.value = String(bahanKritis);
            });
        });
    </script>

    <script>
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            let bahanKritisFixEl = document.querySelector('#bahan-kritis');
            if (bahanKritisFixEl.value === '') {
                await processActivity('{{ csrf_token() }}', 'rule');
            } else {
                let form = document.querySelector('#potensi-bahan-kritis-form');
                form.submit();
            }
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
