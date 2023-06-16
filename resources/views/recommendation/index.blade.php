@extends('../layout/' . $layout)

@section('subhead')
    <title>Rekomendasi Bahan Halal</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-10 px-5 pt-2">
            <h2 class="intro-y text-lg font-medium mr-auto mt-2 mb-5">Rekomendasi Bahan Halal</h2>
            <iframe src="http://halal.its.ac.id/tanya-halal?q={{ $query }}" width="100%" height="800px"></iframe>
        </div>
    </div>
@endsection
