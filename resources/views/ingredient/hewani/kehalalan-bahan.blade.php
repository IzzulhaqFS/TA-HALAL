@extends('../layout/' . $layout)

@section('subhead')
    <title>Kehahalan Bahan Baku {{ ucfirst($bahanBaku) }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-label="Cek Kehalalan Bahan Hewani" 
            data-value="{{ $statusBahanBaku }}">
            Kehahalan Bahan Baku {{ ucfirst($bahanBaku) }}
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
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Input -->
            <div class="intro-y box">
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
                        <!-- BEGIN: Form -->
                        <form id="kehalalan-bahan-form" action="{{ route('hewani.kehalalan-bahan.process', [
                            'ingredient_id' => $ingredient->id, 
                            'bahan-baku' => $bahanBaku, 
                            'kelompok-bahan' => $kelompokBahan]) }}" method="GET">
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Status Kehalalan</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Status Kehalalan Bahan Baku" name="kehalalan-bahan"  disabled value="{{ $statusBahanBaku }}">
                            </div>
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
    @include('../layout/components/predict')
    
    <script>
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            let mainHeaderEl = document.querySelector('#main-header');            
            if (mainHeaderEl.getAttribute('data-value') === "Haram") {
                await processActivity('{{ csrf_token() }}', 'rule');
            } else {
                let form = document.querySelector('#kehalalan-bahan-form');
                window.location.href = form.action;
            }
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
