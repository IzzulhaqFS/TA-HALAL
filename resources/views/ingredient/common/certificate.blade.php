@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Sertifikat Halal Bahan</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        @if ($ingredient->type == 'Hewani')
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos='0' 
            data-label="Cek Sertifikat Halal" 
            data-value="">
            Pengecekan Sertifikat Halal Bahan
        </h2>
        @else
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos='0'
            data-label="Cek sertifikat halal" 
            data-value="">
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
                            <input type="text" class="form-control" disabled value="{{ $ingredient->product_name}}">
                        </div>
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" disabled value="{{ $ingredient->name }}">
                        </div>
                        <form id="is-halal-certified-form" action="{{ route('ingredient.certificate.store') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mt-3">
                                <input type="hidden" class="form-control sub-activity" data-pos='0' data-label="ingredient_id" name="ingredient_id" value="{{ $ingredient->id }}">
                                <label for="regular-form-1" class="form-label">Apakah bahan telah bersertifikat halal?</label>
                                <select id="is-halal-certified-select" class="form-control" name="is-halal-certified">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ old('is-halal-certified') == '1' ? 'selected' : '' }} class="sub-activity" data-pos='0' data-label="Apakah bahan telah bersertifikat halal?">Iya</option>
                                    <option value="0" {{ old('is-halal-certified') == '0' ? 'selected' : '' }} class="sub-activity" data-pos='0' data-label="Apakah bahan telah bersertifikat halal?">Tidak</option>
                                </select>
                            </div>
                            {{-- BEGIN: Certificate Detail --}}
                            @if ($ingredient->type == 'Hewani')
                            <div id="certificate-detail" class="certificate-detail main-activity" 
                                data-pos='1' 
                                data-label="Cek Informasi Sertifikat Halal" 
                                data-value="">
                            @else
                            <div id="certificate-detail" class="certificate-detail main-activity" 
                                data-pos='1' 
                                data-label="Cek informasi sertifikat halal" 
                                data-value="">
                            @endif
                                <div class="mt-4">
                                    <label for="regular-form-1" class="form-label">Nomor Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos='1' data-label="Nomor Sertifikat" name="certificate-number" placeholder="Nomor Sertifikat">
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-1" class="form-label">Lembaga Penerbit Sertifikat</label>
                                    <input type="text" class="form-control sub-activity" data-pos='1' data-label="Lembaga Penerbit Sertifikat" name="certificate-institution" placeholder="Lembaga Penerbit Sertifikat">
                                </div>
                                <div style="display: flex; flex-wrap: wrap;" class="mt-1">
                                    <div class="mt-3">
                                        <label for="regular-form-1" class="form-label">Mulai Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos='1' data-label="Mulai Masa Berlaku" name="certificate-start-date" placeholder="Mulai Masa Berlaku">
                                    </div>
                                    <div class="mt-3 ml-5">
                                        <label for="regular-form-1" class="form-label">Akhir Masa Berlaku</label>
                                        <input type="date" class="form-control sub-activity" data-pos='1' data-label="Akhir Masa Berlaku" name="certificate-end-date" placeholder="Akhir Masa Berlaku">
                                    </div>
                                </div>
                            </div>
                            {{-- END: Certificate Detail --}}
                        </form>
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

    {{-- BEGIN: Additional Scripts --}}
    <script>
        let selectEl = document.querySelector('#is-halal-certified-select');
        let certDetailEl = document.querySelector('#certificate-detail');
        
        // Add an event listener to the select element to listen for changes
        selectEl.addEventListener('change', function() {
            // Check if the selected value is "1"
            if (selectEl.value === "1") {
                // If it is, show the certificate-detail div
                certDetailEl.style.display = 'block';
                document.getElementById('main-header').setAttribute('data-value', 'Halal');
                certDetailEl.setAttribute('data-value', 'Halal');
            } else {
                // Otherwise, hide it
                certDetailEl.style.display = 'none';
                document.getElementById('main-header').setAttribute('data-value', 'Syubhat');
                removeActivityValue(certDetailEl);
            }
        });

        // Call the event listener once on page load to set the initial state of the div
        selectEl.dispatchEvent(new Event('change'));
    </script>
    
    <script>
        // Process Activity if isHalalCertified
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            let form = document.querySelector('#is-halal-certified-form');
        
            // Serialize the form data
            let formData = new FormData(form);

            try {
                // Send the POST request to the Laravel route
                let response = await fetch(form.action, {
                    method: 'PUT',
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
                
                let selectEl = document.querySelector('#is-halal-certified-select');
                if (selectEl.value === "1") {
                    await processActivity('{{ csrf_token() }}', 'rule');
                }
            } catch (error) {
                // Handle any errors that occur during the request
                console.error(error);
            }
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
