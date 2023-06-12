@extends('../layout/' . $layout)

@section('subhead')
    <title>Profil User</title>
@endsection

@section('subcontent')
    <div id="mover-container" class="mt-5">
        <h2 id="main-header" class="text-lg font-medium mr-auto">Profil User</h2>
        <button class="btn btn-outline-success inline-block" id="edit-btn">
            <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
            Edit Profil
        </button>
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
    <form id="update-user-form" action="{{ route('user.update', ['user_id' => $user->id]) }}"  method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 lg:col-span-6">
                <!-- BEGIN: Input -->
                <div class="intro-y box">
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->name }}" name="name">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">Email</label>
                                <input type="email" class="form-control sub-activity" disabled value="{{ $user->email }}" name="email">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">NIK</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->id_card }}" name="id_card">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Jenis Kelamin</label>
                                <select id="ingredient-type-select" class="form-control" disabled name="gender">
                                    <option value="wanita" {{ $user->gender == 'wanita' ? 'selected' : ''}}>Wanita</option>
                                    <option value="pria"  {{ $user->gender == 'pria' ? 'selected' : ''}}>Pria</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-5" class="form-label">Telepon</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->phone }}" name="phone">
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-8" class="form-label">Nama UMKM</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->umkm_name }}" name="umkm_name">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-7" class="form-label">No. UMKM</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->umkm_id }}" name="umkm_id">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-9" class="form-label">Alamat UMKM</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->umkm_address }}" name="umkm_address">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-10" class="form-label">Kota asal UMKM</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->umkm_city }}" name="umkm_city">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-11" class="form-label">Negara asal UMKM</label>
                                <input type="text" class="form-control sub-activity" disabled value="{{ $user->umkm_country }}" name="umkm_country">
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- END: Input -->
        </div>
        <div id="mover-container" class="mt-5">
            <a href="{{ route('index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
            <div id="submit-box" style="display: none;">
                <button id="submit-btn" type="submit" class="btn btn-danger">Perbarui</button>
            </div>
        </div>
    </form>
    <!-- END: Form -->

    {{-- BEGIN: Additional Scripts --}}
    <script>
        const editBtn = document.getElementById('edit-btn');
        const form = document.getElementById('update-user-form');
        const inputs = form.querySelectorAll('input');
        const selects = form.querySelectorAll('select');
        const submitBox = form.querySelector('#submit-box');

        let isEditMode = false;

        editBtn.addEventListener('click', function() {
            isEditMode = !isEditMode; // Toggle edit mode

            if (isEditMode) {
                submitBox.style.display = 'block';
                // Enable input fields
                inputs.forEach(function(input) {
                    input.disabled = false;
                });
                selects.forEach(function(select) {
                    select.disabled = false;
                });
                editBtn.textContent = 'Batal'; // Change button text
            } else {
                location.reload();
            }
        });

    </script>
@endsection
