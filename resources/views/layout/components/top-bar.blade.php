<!-- BEGIN: Top Bar -->
<div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">App</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{  empty($breadcrumb) ? 'Home' : ucfirst(trim($breadcrumb, '/')) }}</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Cari...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
        </a>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Account Menu -->
    @php
        $user = Auth()->user();
    @endphp
    @if ($user)
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                @if ($user?->gender == "wanita")
                    <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/profile-akhwat.png') }}">
                @else
                    <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/profile-ikhwan.png') }}">
                @endif
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ $user?->name }}</div>
                        <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ $user?->umkm_name }}</div>
                    </li>
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        <a href="{{ route('user.show', ['user_id'=> $user?->id]) }}" class="dropdown-item hover:bg-white/5">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profil
                        </a>
                    </li>
                    {{-- <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Bantuan
                        </a>
                    </li> --}}
                    <li><hr class="dropdown-divider border-white/[0.08]"></li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                            <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
