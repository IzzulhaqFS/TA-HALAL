@extends('../layout/' . $layout)
    
@section('subhead')
    <title>Detail Bahan</title>
@endsection

@section('subcontent')
    <div id="mover-container" class="mt-5">
        <h2 class="intro-y text-lg font-medium">Detail Bahan</h2>
        <a class="btn btn-outline-success w-24 inline-block" href="{{ route('product.show', ['product_id' => $product->id]) }}" id="back-btn">Kembali</a>
    </div>

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
        <!-- BEGIN: Detail Hasil -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible px-8 pb-4">
            <div class=" border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
                <div class="px-5 sm:px-20 py-12">
                    <div class="text-primary font-semibold text-3xl">{{ $ingredient->name }}</div>
                    <div class="mt-2">Case ID&nbsp;<span class="font-medium">:&nbsp;{{ $ingredient->id }}</span></div>
                    <div class="mt-1">Penguji&nbsp;<span class="font-medium">:&nbsp;{{ $username }}</span></div>
                    <div class="mt-1">Jenis Bahan&nbsp;<span class="font-medium">:&nbsp;{{ $ingredient->type }}</span></div>
                </div>
                <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-2 pb-10">
                    <div>
                        <div class="text-base">Hasil Pengecekan Bahan</div>
                        @if ($ingredient->status_halal == 'Halal')
                            <div class="text-2xl font-medium text-primary mt-2">Halal</div>
                            <div class="mt-1"><i>Bahan termasuk bahan halal</i></div>
                        @elseif ($ingredient->status_halal == 'Haram')
                            <div class="text-2xl font-medium text-danger mt-2">Haram</div>
                            <div class="mt-1"><i>Bahan berpotensi haram</i></div>
                        @elseif ($ingredient->status_halal == 'Syubhat')
                            <div class="text-2xl font-medium text-warning mt-2">Syubhat</div>
                            <div class="mt-1"><i>Bahan tergolong syubhat dan harus ditelusuri lebih lanjut</i></div>
                        @else
                            <div class="text-2xl font-medium text-danger mt-2">Dalam Proses</div>
                            <div class="mt-1"><i>Proses pengecekan bahan belum selesai</i></div>
                        @endif

                    </div>
                    <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                        <div class="text-base">Bahan dari produk</div>
                        <div class="text-lg font-medium text-primary mt-2">{{ $product->name }}</div>
                    </div>
                </div>
            </div>
            @if (count($listPotensiHaram) > 0)
                <div class="flex flex-col sm:flex-row my-5">
                    <h2 class="font-medium text-base mr-auto">
                        Daftar Potensi Haram
                    </h2>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">NO</th>
                            <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                            <th class="text-center whitespace-nowrap">STATUS</th>
                            <th class="text-center whitespace-nowrap">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($listPotensiHaram as $potensiHaram)
                        <tr>
                            <td class="w-4">{{ $i }}</td>
                            <td>{{ $potensiHaram[0]->activity }}</td>
                            <td class="w-40">
                                @if ($potensiHaram[0]->status_halal == 'Halal')
                                <div class="flex items-center justify-center text-success">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ is_null($potensiHaram[0]->status_halal) ? 'Dalam Proses' : $potensiHaram[0]->status_halal }}
                                </div>
                                @elseif ($potensiHaram[0]->status_halal == 'Haram')
                                <div class="flex items-center justify-center text-danger text-bold">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i> {{ is_null($potensiHaram[0]->status_halal) ? 'Dalam Proses' : $potensiHaram[0]->status_halal }}
                                </div>
                                @else
                                <div class="flex items-center justify-center text-warning">
                                    <i data-lucide="slack" class="w-4 h-4 mr-2"></i> {{ is_null($potensiHaram[0]->status_halal) ? 'Dalam Proses' : $potensiHaram[0]->status_halal }}
                                </div>  
                                @endif
                            </td>
                            <td class="table-report__action" style="width: 25rem;">
                                <div class="flex justify-center items-center">
                                    @if ($potensiHaram[1])
                                    <a class="flex items-center text-success mr-5" href="{{ route('recommendation.index') }}?activity={{ $potensiHaram[0]->activity }}">
                                        <i data-lucide="search" class="w-4 h-4 mr-1"></i>Lihat Rekomendasi Pengganti
                                    </a>
                                    @else
                                        <p>-</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="flex flex-col sm:flex-row my-5">
                    <h2 class="font-medium text-base mr-auto">
                        Detail Daftar Potensi Haram
                    </h2>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">NO</th>
                            <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                            <th class="text-center whitespace-nowrap">SUB AKTIVITAS</th>
                            <th class="text-center whitespace-nowrap">ISIAN</th>
                            <th class="text-center whitespace-nowrap">WAKTU PENGISIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $j = 1 @endphp
                        @foreach ($listPotensiHaram as $potensiHaram)
                        @foreach ($potensiHaram[0]->subActivity as $potensi)
                            @php 
                                $potensiValue = $potensi->value; 
                                if ($potensi->value === "1") {
                                    $potensiValue = 'Iya / Positif';
                                } else if ($potensi->value === "0") {
                                    $potensiValue = 'Tidak / Negatif';
                                }
                            @endphp
                            <tr>
                                <td>{{ $j }}</td>
                                <td>{{ $potensiHaram[0]->activity }}</td>
                                <td>{{ $potensi->description }}</td>
                                <td>{{ $potensiValue  }}</td>
                                <td>{{ $potensi->updated_at }}</td>
                            </tr>
                            @php $j++ @endphp
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
            </div>
        @endif
        <!-- END: Detail Hasil -->
        <!-- BEGIN: Detail Aktivitas -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible px-8 pb-8">
            <div class="flex flex-col sm:flex-row my-5">
                <h2 class="font-medium text-lg mr-auto">
                    <u>Detail Aktivitas</u> 
                </h2>
            </div>
            {{-- <style>
                .table th {
                    padding: 0px
                } 
                .table td {
                    padding: 0px
                } 
            </style> --}}
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventLogs as $key => $eventLog)
                    <tr>
                        <td class="w-5">{{ $key + 1 }}</td>
                        <td>{{ $eventLog->activity }}</td>
                        <td class="">
                            @if ($eventLog->status_halal == 'Halal')
                            <div class="flex items-center justify-center text-success">
                                <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ is_null($eventLog->status_halal) ? 'Dalam Proses' : $eventLog->status_halal }}
                            </div>
                            @elseif ($eventLog->status_halal == 'Haram')
                            <div class="flex items-center justify-center text-danger text-bold">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i> {{ is_null($eventLog->status_halal) ? 'Dalam Proses' : $eventLog->status_halal }}
                            </div>
                            @else
                            <div class="flex items-center justify-center text-warning">
                                <i data-lucide="slack" class="w-4 h-4 mr-2"></i> {{ is_null($eventLog->status_halal) ? 'Dalam Proses' : $eventLog->status_halal }}
                            </div>  
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-check form-switch w-auto mt-8">
                <label class="form-check-label font-medium mr-3" for="show-sub-activity">Tampilkan isian pada setiap aktivitas</label>
                <input id="show-sub-activity" data-target="#sub-activity-list" class="show-code form-check-input ml-0" type="checkbox">
            </div>
        </div>
        <!-- END: Detail Aktivitas -->
        
        <!-- BEGIN: Detail Sub Aktivitas -->
        <div id="sub-activity-list" class="source-code hidden box intro-y col-span-12 overflow-auto lg:overflow-visible px-8 pb-8">
            <div class="flex flex-col sm:flex-row my-5">
                <h2 class="font-medium text-lg mr-auto">
                    <u>Detail Sub Aktivitas</u> 
                </h2>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">SUB AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">ISIAN</th>
                        <th class="text-center whitespace-nowrap">WAKTU PENGISIAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventLogs as $key => $eventLog)
                        @foreach ($eventLog->subActivity as $subActivity)
                        @php 
                            $subActivityValue = $subActivity->value; 
                            if ($subActivity->value === "1") {
                                $subActivityValue = 'Iya / Positif';
                            } else if ($subActivity->value === "0") {
                                $subActivityValue = 'Tidak / Negatif';
                            }
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $eventLog->activity }}</td>
                            <td>{{ $subActivity->description }}</td>
                            <td>{{ $subActivityValue }}</td>
                            <td>{{ $subActivity->updated_at }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.getElementById('show-sub-activity').addEventListener('change', function() {
                var subActivityList = document.getElementById('sub-activity-list');
                
                if (this.checked) {
                    subActivityList.style.display = 'block';
                } else {
                    subActivityList.style.display = 'none';
                }
            });
        </script>
        <!-- END: Detail Sub Aktivitas -->
@endsection
