@extends('../layout/' . $layout)

@section('subhead')
    <title>Registrasi User</title>
@endsection

@section('subcontent')
    <div id="mover-container" class="mt-5">
        <h2 id="main-header" class="text-lg font-medium mr-auto">Registrasi User</h2>
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
    <form id="update-user-form" action="{{ route('user.store') }}"  method="POST">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="cl-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                        <i class="text-xs mr-auto"><span class="text-danger">*</span>&nbsp;Wajib diisi</i>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-1" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control sub-activity" value="" name="name">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control sub-activity" value="" name="email">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control sub-activity" value="" name="password">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control sub-activity" value="" name="password_confirmation">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-2" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control sub-activity" value="" name="id_card">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-1" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select id="ingredient-type-select" class="form-control" name="gender">
                                    <option value="">-- Pilih --</option>
                                    <option value="wanita">Wanita</option>
                                    <option value="pria">Pria</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-5" class="form-label">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control sub-activity" value="" name="phone">
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                        <i class="text-xs mr-auto"><span class="text-danger">*</span>&nbsp;Wajib diisi</i>
                    </div>
                    <div id="input" class="p-5">
                        <div class="preview">
                            <div>
                                <label for="regular-form-8" class="form-label">Nama UMKM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control sub-activity" value="" name="umkm_name">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-7" class="form-label">No. UMKM</label>
                                <input type="text" class="form-control sub-activity" value="" name="umkm_id">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-9" class="form-label">Alamat UMKM</label>
                                <input type="text" class="form-control sub-activity" value="" name="umkm_address">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-10" class="form-label">Kota asal UMKM</label>
                                <input type="text" class="form-control sub-activity" value="" name="umkm_city">
                            </div>
                            <div class="mt-3">
                                <label for="regular-form-11" class="form-label">Negara asal UMKM</label>
                                <input type="text" class="form-control sub-activity" value="" name="umkm_country">
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- END: Input -->
        </div>
        <div id="mover-container" class="mt-5">
            <a href="{{ route('login.index') }}" id="left-btn" class="btn btn-outline-primary w-24 inline-block">Kembali</a>
            <button id="submit-btn" type="submit" class="btn btn-danger">Buat Akun</button>
        </div>
    </form>
    <!-- END: Form -->
@endsection
