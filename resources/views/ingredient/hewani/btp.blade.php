@extends('../layout/' . $layout)

@section('subhead')
    <title>Pengecekan Bahan Tambahan Pangan</title>
@endsection

@section('subcontent')
    <script>
        function removeActivityValue(element) {
            element.setAttribute('data-value', '');

            // Set 'data-value' property to empty string for element and child elements with 'main-activity' class
            let mainActivityElements = element.querySelectorAll('.main-activity');
            mainActivityElements.forEach(function (mainActivityElement) {
                mainActivityElement.setAttribute('data-value', '');
            });

            // Clear input values
            let inputElements = element.querySelectorAll('input');
            inputElements.forEach(function (inputElement) {
                inputElement.value = '';
            });

            // Reset selected option for select elements
            let selectElements = element.querySelectorAll('select');
            selectElements.forEach(function (selectElement) {
                selectElement.selectedIndex = 0;
                let options = selectElement.querySelectorAll('option');
                options.forEach(function (option) {
                    option.classList.remove('sub-activity');
                });
            });
            
            // Select all input type checkboxes within the parent element
            const checkboxes = element.querySelectorAll('input[type="checkbox"]');
            // Uncheck each checkbox
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    </script>
    <div class="intro-y flex items-center mt-8">
        <h2 id="main-header" class="text-lg font-medium mr-auto main-activity" 
            data-pos='0' 
            data-label="Cek Bahan Tambahan" 
            data-value="Syubhat">
            Pengecekan Bahan Tambahan Pangan
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
                            <input type="text" class="form-control" disabled value="{{ $ingredient->product_name}}">
                        </div>
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" disabled value="{{ $ingredient->name }}">
                        </div>
                        <div class="mt-3">
                            <label for="regular-form-1" class="form-label">Bahan Baku</label>
                            <input id="regular-form-1" type="text" class="form-control" disabled value="{{ ucfirst($bahanBaku) }}">
                        </div>
                        @foreach ($arrayBTP as $BTP)
                            @include('../ingredient/hewani/' . $BTP)
                        @endforeach
                        <div id="mover-container" class="mt-5">
                            <a href="javascript:void(0)" onclick="history.back()" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                            <button id="right-btn" type="submit" class="btn btn-primary w-32 inline-block">Ambil Kesimpulan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Input -->
        </div>
    </div>
    <!-- END: Form -->

    <script>
        let mainElems = document.querySelectorAll('.main-activity');
        mainElems.forEach(function (elem, index) {
            elem.setAttribute('data-pos', index);
            let subElems = elem.querySelectorAll('.sub-activity');
            subElems.forEach(function (subElem) {
                subElem.setAttribute('data-pos', index);
            });
        });
    </script>
    
    @include('../layout/components/processing-script')

    {{-- BEGIN: Additional Scripts --}}
    <script>
        document.getElementById('right-btn').addEventListener('click', async function(e) {
            await processActivity('{{ csrf_token() }}', 'prediction');
        })
    </script>
    {{-- END: Additional Scripts --}}

@endsection
