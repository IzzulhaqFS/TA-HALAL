@extends('../layout/' . $layout)

@section('subhead')
    <title>Web Kesiapan Sertifikasi Halal</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Laporan Umum -->
                <div class="col-span-12 xl:col-span-9 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Laporan Umum</h2>
                    </div>
                    <div class="report-box-2 intro-y mt-5">
                        <div class="box grid grid-cols-12">
                            <div class="col-span-12 lg:col-span-4 pl-16 flex flex-col px-8 py-12">
                                <i data-lucide="pie-chart" class="w-10 h-10 text-pending"></i>
                                <div class="justify-start flex items-center font-medium mt-9">
                                    Total Produk Saya
                                </div>
                                <div class="flex items-center justify-start mt-4">
                                    <div class="relative text-2xl font-medium pl-3 ml-0.5">
                                        <span class="absolute text-xl font-medium top-0 left-0 -ml-0.5"></span> {{ $data['productCount'] }}
                                    </div>
                                </div>
                                <div class="justify-start flex items-center font-medium mt-8">
                                    Total Bahan Saya
                                </div>
                                <div class="flex items-center justify-start mt-4">
                                    <div class="relative text-2xl font-medium pl-3 ml-0.5">
                                        <span class="absolute text-xl font-medium top-0 left-0 -ml-0.5"></span> {{ $data['ingredientCount'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-8 py-10 px-6 border-t lg:border-t-0 lg:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                                <ul class="nav nav-pills w-60 border border-slate-300 dark:border-darkmode-300 border-dashed rounded-md mx-auto p-1 mb-8" role="tablist">
                                    <li id="detail-aktivitas-penelusuran-tab" class="nav-item flex-1" role="presentation">
                                        <div
                                            class="nav-link w-full py-1.5 px-2 active text-center"
                                            data-tw-toggle="pill"
                                            data-tw-target="#detail-aktivitas-penelusuran"
                                            role="tab"
                                            aria-controls="detail-aktivitas-penelusuran"
                                            aria-selected="true"
                                        >
                                            Detail Aktivitas Penelusuran
                                    </div>
                                    </li>
                                    </li>
                                </ul>
                                <div class="tab-content px-5 pb-5">
                                    <div class="tab-pane active grid grid-cols-12 gap-y-8 gap-x-10" id="detail-aktivitas-penelusuran" role="tabpanel" aria-labelledby="detail-aktivitas-penelusuran-tab">
                                        <div class="col-span-6 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Jumlah Aktivitas</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['eventLogCount'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Bahan Selesai Dicek</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['doneIngredientCount']}}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Bahan Masih Diproses</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['inProcessIngredientCount']}}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Aktivitas Berstatus Halal</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['halalActivity'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Aktivitas Berstatus Syubhat</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['syubhatActivity'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Aktivitas Berstatus Haram</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['haramActivity'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Bahan Berstatus Halal</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['halalIngredientCount'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Bahan Berstatus Syubhat</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['syubhatIngredientCount'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-6 md:col-span-4">
                                            <div class="text-slate-500">Bahan Berstatus Haram</div>
                                            <div class="mt-1.5 flex items-center">
                                                <div class="text-base">{{ $data['haramIngredientCount'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Laporan Umum -->
                <!-- BEGIN: Statistik Bahan-->
                <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 row-start-4 lg:row-start-3 xl:row-start-auto mt-6 xl:mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Statistik Bahan</h2>
                    </div>
                    <div class="report-box-2 before:hidden xl:before:block intro-y mt-5">
                        <div class="box p-5">
                            <div class="mt-3">
                                <div class="h-[196px]">
                                    <canvas id="report-donut-chart"></canvas>
                                </div>
                            </div>
                            <div class="w-52 sm:w-auto mx-auto mt-8">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                    <span class="truncate">Bahan Halal</span>
                                    <span class="font-medium ml-auto">{{ $data['halalPercentage'] }}%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                    <span class="truncate">Bahan Syubhat</span>
                                    <span class="font-medium ml-auto">{{ $data['syubhatPercentage'] }}%</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                    <span class="truncate">Bahan Haram</span>
                                    <span class="font-medium ml-auto">{{ $data['haramPercentage'] }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Statistik Bahan-->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Himbauan & Tips -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-auto">Himbauan & Tips</h2>
                            <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="mt-5 intro-x">
                            <div class="box zoom-in">
                                <div class="tiny-slider" id="important-notes">
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Himbauan & Tips -->
                </div>
            </div>
        </div>
    </div>
@endsection
