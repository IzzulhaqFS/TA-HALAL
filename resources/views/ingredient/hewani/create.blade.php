@extends('../layout/' . $layout)

@section('subhead')
    <title>Cek Bahan Baru</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Informasi Bahan</h2>
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
    <form id="create-ingredient-form"  action="{{ route('ingredient.store') }}"  method="POST">
        @csrf
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
                                <label for="regular-form-1" class="form-label">Nama Bahan</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Nama Bahan" name="name" placeholder="Nama Bahan">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Tipe Bahan</label>
                                <select id="regular-form-1" class="form-control" name="type">
                                    <option value="">-- Pilih Tipe Bahan --</option>
                                    <option value="Hewani" {{ old('type') == 'Hewani' ? 'selected' : '' }} class="sub-activity" data-label="Tipe Bahan">Hewani</option>
                                    <option value="Nabati" {{ old('type') == 'Nabati' ? 'selected' : '' }} class="sub-activity" data-label="Tipe Bahan">Nabati</option>
                                </select>
                            </div>
                            
                            <input id="regular-form-1" type="hidden" class="form-control sub-activity" data-label="product_id" name="product_id" value="{{ $product_id }}">
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('product.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                                <button id="submit-btn" type="submit" class="btn btn-primary w-24 inline-block">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Input -->
            </div>
        </div>
    </form>
    <!-- END: Form -->

    <script src="{{ asset('dist/scripts/storeDataToSession.js') }}"></script>
    
    <script>
        const getMainValue = () => {
            return 'Woke';
        };
    </script>

    <script>
        storeDataToSession(getMainValue());
    </script>

@endsection
