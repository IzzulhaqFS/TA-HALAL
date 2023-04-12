@extends('../layout/' . $layout)

@section('subhead')
    <title>Cek Bahan Baru</title>
    <script>
        sessionStorage.removeItem('main-activity');
        sessionStorage.removeItem('sub-activity');
    </script>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity" data-main-label="">Informasi Bahan</h2>
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
                                <input type="text" class="form-control sub-activity" disabled data-label="Nama Produk" value="{{ $product->name }}">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Nama Bahan</label>
                                <input type="text" class="form-control sub-activity" data-label="Nama Bahan" name="name" placeholder="Nama Bahan">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Tipe Bahan</label>
                                <select id="ingredient-type-form" class="form-control" name="type">
                                    <option value="">-- Pilih Tipe Bahan --</option>
                                    <option value="Hewani" {{ old('type') == 'Hewani' ? 'selected' : '' }} class="sub-activity" data-label="Tipe Bahan">Hewani</option>
                                    <option value="Nabati" {{ old('type') == 'Nabati' ? 'selected' : '' }} class="sub-activity" data-label="Tipe Bahan">Nabati</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah bahan termasuk dalam positif list?</label>
                                <select id="is-positif-list-form" class="form-control" name="is-positif-list">
                                    <option value="">-- Pilih --</option>
                                    <option value="0" {{ old('is-positif-list') == '0' ? 'selected' : '' }} class="sub-activity" data-label="Apakah bahan termasuk dalam poisitif list?">Tidak</option>
                                    <option value="1" {{ old('is-positif-list') == '1' ? 'selected' : '' }} class="sub-activity" data-label="Apakah bahan termasuk dalam poisitif list?">Iya</option>
                                </select>
                                <script>
                                    const select = document.querySelector('#ingredient-type-form');
                                    const h2 = document.querySelector('.main-activity');
                                  
                                    select.addEventListener('change', () => {
                                        if (select.value === 'Hewani') {
                                            h2.setAttribute('data-main-label', 'Mengisi Info Bahan');
                                        } else if (select.value === 'Nabati') {
                                            h2.setAttribute('data-main-label', 'Cek informasi bahan');
                                        }
                                    });
                                  </script>
                            </div>
                            
                            <input id="regular-form-1" type="hidden" class="form-control sub-activity" data-label="product_id" name="product_id" value="{{ $product->id }}">
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
    </form>
    <!-- END: Form -->

    <script src="{{ asset('dist/scripts/storeDataToSession.js') }}"></script>
    
    <script>
        const getMainValue = () => {
            const select = document.querySelector('#is-positif-list-form');
            if (select.value === '1') {
                return 'Halal'
            } else if (select.value === '0') {
                return 'Syubhat'
            }
        };
    </script>

    <script>
        storeDataToSession();
    </script>

    <script>
        // Submit the form data to the Laravel route
        document.getElementById('right-btn').addEventListener('click', function(e) {
            let form = document.querySelector('#create-ingredient-form');
            form.action = '{{ route("ingredient.store") }}';
            form.submit();
        })
    </script>

@endsection
