@extends('../layout/' . $layout)
    
@section('subhead')
    <title>Daftar Produk</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Daftar Produk</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
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
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('product.create') }}" class="btn btn-primary inline-block mr-1 mb-2 pr-5"><i data-lucide="plus" class="w-5"></i> Cek Produk Baru</a>
            <div class="w-full sm:w-auto mt-3 mt-0 ml-auto">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Cari...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">NAMA PRODUK</th>
                        <th class="text-center whitespace-nowrap">JUMLAH BAHAN
                            <span id="explanation">
                                <i 
                                    data-lucide="help-circle" class="tooltip w-4"
                                    style="margin-bottom: 0.1rem" 
                                    title="1 produk dapat terdiri dari banyak bahan/komposisi.">
                                </i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">STATUS </th>
                        <th class="text-center whitespace-nowrap">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr class="intro-x">
                            <td>
                                <p class="font-medium whitespace-nowrap ml-1">{{ $key + 1 + (($products->currentPage() - 1) * $products->perPage()) }}</p>
                            </td>
                            <td>
                                <p class="font-medium text-center">{{ $product->name }}</p>
                            </td>
                            <td class="text-center">{{ $product->ingredient_count }}</td>
                            <td class="w-40">
                                @if ($product->product_status == 'Halal')
                                <div class="flex items-center justify-center text-success">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ is_null($product->product_status) ? 'Dalam Proses' : $product->product_status }}
                                </div>
                                @elseif ($product->product_status == 'Haram')
                                <div class="flex items-center justify-center text-danger text-bold">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i> {{ is_null($product->product_status) ? 'Dalam Proses' : $product->product_status }}
                                </div>
                                @else
                                <div class="flex items-center justify-center text-warning">
                                    <i data-lucide="slack" class="w-4 h-4 mr-2"></i> {{ is_null($product->product_status) ? 'Dalam Proses' : $product->product_status }}
                                </div>  
                                @endif
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-success mr-5" href="{{ route('ingredient.create', ['product_id'=> $product->id]) }}">
                                        <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Cek Bahan Lainnya
                                    </a>
                                    <a class="flex items-center text-info mr-5" href="{{ route('product.show', ['product_id'=> $product->id]) }}">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-1"></i> Detail
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal-{{ $product->id }}">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- BEGIN: Delete Confirmation Modal -->
                        <div id="delete-confirmation-modal-{{ $product->id }}" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <form action="{{ route('product.destroy', ['product_id'=> $product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="p-5 text-center">
                                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                <div class="text-3xl mt-5">Apakah anda yakin?</div>
                                                <div class="text-slate-500 mt-2">Apakah Anda benar-benar ingin menghapus item ini?<br>Proses ini tidak dapat dibatalkan.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                                                <button type="submit" class="btn btn-danger w-24">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Delete Confirmation Modal -->
                    @endforeach
                </tbody>
            </table>
            <div class="ml-3 mt-6">
                {{ $products->links() }}
            </div>
            <script>
                const spanElement = document.querySelector('span.relative.z-0.inline-flex.shadow-sm.rounded-md');
                spanElement.classList.add('ml-4');
                spanElement.classList.add('-mt-2');
            </script>
        </div>
        <!-- END: Data List -->
    </div>

@endsection
