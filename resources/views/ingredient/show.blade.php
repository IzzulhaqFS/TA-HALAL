@extends('../layout/' . $layout)
    
@section('subhead')
    <title>Detail Bahan</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Detail Bahan (<b>{{ $ingredient->name }}</b>)</h2>
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
            <div class="w-full sm:w-auto mt-3 mt-0 ml-auto">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Cari...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible px-8 pb-8">
            <div class="flex flex-col sm:flex-row my-5">
                <h2 class="font-medium text-base mr-auto">
                    Detail Aktivitas 
                </h2>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">CASE ID</th>
                        <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ID PENGUJI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventLogs as $key => $eventLog)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="w-56">{{ $eventLog->ingredient_id }}</td>
                        <td>{{ $eventLog->activity }}</td>
                        <td class="w-44">
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
                        <td class="w-56">{{ $eventLog->user_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr style="width:100%">
        <div class="box intro-y col-span-12 overflow-auto lg:overflow-visible px-8 pb-8">
            <div class="flex flex-col sm:flex-row my-5">
                <h2 class="font-medium text-base mr-auto">
                    Detail Sub Aktivitas 
                </h2>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">SUB AKTIVITAS</th>
                        <th class="text-center whitespace-nowrap">ISIAN</th>
                        <th class="text-center whitespace-nowrap">TIMESTAMP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventLogs as $key => $eventLog)
                        @foreach ($eventLog->subActivity as $subActivity)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $eventLog->activity }}</td>
                            <td>{{ $subActivity->description }}</td>
                            <td>{{ $subActivity->value }}</td>
                            <td>{{ $subActivity->updated_at }}</td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
