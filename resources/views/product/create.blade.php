@extends('../layout/' . $layout)

@section('subhead')
    <title>Cek Produk Baru</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Informasi Produk</h2>
    </div>
    <form id="create-product-form"  action="{{ route('product.store') }}"  method="POST">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12">
                <!-- BEGIN: Input -->
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Input</h2>
                        <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                            <input id="show-example-1" data-target="#input" class="show-code form-check-input mr-0 ml-3" type="checkbox">
                        </div>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama Produk</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Nama Produk" name="name" placeholder="Nama Produk">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Supplier</label>
                                <input id="regular-form-1" type="text" class="form-control sub-activity" data-label="Supplier" name="supplier" placeholder="Supplier">
                            </div>
                            <div id="mover-container" class="mt-5">
                                <a href="" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
                                <button id="submit-btn" type="submit" class="btn btn-primary w-24 inline-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Input -->
            </div>
        </div>
    </form>

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
