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
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" data-label="" data-value="Syubhat">Informasi Bahan</h2>
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
                            <input id="regular-form-1" type="hidden" class="form-control sub-activity" data-label="product_id" name="product_id" value="{{ $product->id }}">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control sub-activity" disabled data-label="Nama Produk" value="{{ $product->name }}">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Nama Bahan</label>
                                <input type="text" class="form-control sub-activity" data-label="Nama Bahan" name="nama-bahan" placeholder="Nama Bahan">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Tipe Bahan</label>
                                <select id="ingredient-type-select" class="form-control" name="type">
                                    <option value="">-- Pilih Tipe Bahan --</option>
                                    <option value="Hewani" {{ old('type') == 'Hewani' ? 'selected' : '' }} class="" data-label="Tipe Bahan">Hewani</option>
                                    <option value="Nabati" {{ old('type') == 'Nabati' ? 'selected' : '' }} class="" data-label="Tipe Bahan">Nabati</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Apakah bahan termasuk dalam positif list?</label>
                                <select id="is-positive-list-select" class="form-control" name="is-positive-list">
                                    <option value="">-- Pilih --</option>
                                    <option value="0" {{ old('is-positive-list') == '0' ? 'selected' : '' }} class="" data-label="Apakah bahan termasuk dalam poisitif list?">Tidak</option>
                                    <option value="1" {{ old('is-positive-list') == '1' ? 'selected' : '' }} class="" data-label="Apakah bahan termasuk dalam poisitif list?">Iya</option>
                                </select>
                            </div>
                            
                            <div id="mover-container" class="mt-5">
                                <a href="{{ route('product.show', ['product_id' => $product->id]) }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
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

    @include('../layout/components/processing-script')
    
    {{-- BEGIN: Additional Scripts --}}
    <script>
        const isPositiveSelect = document.querySelector('#is-positive-list-select');
        const mainHeader = document.querySelector('#main-header');

        isPositiveSelect.addEventListener('change', function() {
            if (isPositiveSelect.value === '1') {
                mainHeader.setAttribute('data-value', 'Halal');
            } else {
                mainHeader.setAttribute('data-value', 'Syubhat');
            }
        });
    </script>
    <script>
        // Adjustment for 2 models
        const typeSelect = document.querySelector('#ingredient-type-select');
        const h2 = document.querySelector('.main-activity');
      
        typeSelect.addEventListener('change', () => {
            if (typeSelect.value === 'Hewani') {
                h2.setAttribute('data-label', 'Mengisi Info Bahan');
            } else if (typeSelect.value === 'Nabati') {
                h2.setAttribute('data-label', 'Cek informasi bahan');
            }
        });
    </script>

    <script>
        // Submit the form data to the Laravel route
        document.getElementById('right-btn').addEventListener('click',  async function(e)  {
            let form = document.querySelector('#create-ingredient-form');

            // Serialize the form data
            let formData = new FormData(form);

            try {
                // Send the POST request to the Laravel route
                let response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: new URLSearchParams(formData).toString(),
                });

                if (response.redirected) {
                    window.location.href = response.url;
                } else if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                // Continue with the processActivity function
                const isPostiveSelect = document.querySelector('#is-positive-list-select');
                if (isPostiveSelect.value === '1') {
                    await processActivity('{{ csrf_token() }}');
                }
            } catch (error) {
                // Handle any errors that occur during the request
                console.error(error);
            }
        })
    </script>
    {{-- END: Additional Scripts --}}
    

@endsection
