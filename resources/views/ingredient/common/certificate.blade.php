@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Sertifikat Halal Bahan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        @if ($ingredient->type == 'Hewani')
        <h2 class="text-lg font-medium mr-auto main-activity" data-main-label="Cek Sertifikat Halal">
            Pengecekan Sertifikat Halal Bahan
        </h2>
        @else
        <h2 class="text-lg font-medium mr-auto main-activity" data-main-label="Cek sertifikat halal">
            Pengecekan Sertifikat Halal Bahan
        </h2>
        @endif
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
                                <label for="regular-form-1" class="form-label">Nama Produk</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" disabled value="{{ $ingredient->product_name}}">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Nama Bahan</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" disabled name="name" value="{{ $ingredient->name }}">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah Bahan Telah Bersertifikat Halal?</label>
                                <select id="regular-form-1" class="form-control" name="type">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('type') == '1' ? 'selected' : '' }} class="sub-activity" data-label="Apakah Bahan Telah Bersertifikat Halal?">Iya</option>
                                    <option value="0" {{ old('type') == '0' ? 'selected' : '' }} class="sub-activity" data-label="Apakah Bahan Telah Bersertifikat Halal?">Tidak</option>
                                </select>
                            </div>
                            
                            <input id="regular-form-1" type="hidden" class="form-control sub-activity" data-label="product_id" name="product_id" value="{{ $ingredient->id }}">
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
