@php
    $user = Auth::user();
    $isAdmin = $user?->isAdmin();
    $isDosen = $user?->isDosen();
    $isMahasiswa = $user?->isMahasiswa();

    $dashboardHref = $isAdmin
        ? route('admin.dashboard')
        : ($isDosen
            ? route('dosen.dashboard')
            : ($isMahasiswa
                ? route('mahasiswa.dashboard')
                : route('dashboard')));

    $dashboardActive = request()->routeIs('dashboard')
        || request()->routeIs('admin.dashboard')
        || request()->routeIs('dosen.dashboard')
        || request()->routeIs('mahasiswa.dashboard');

    $roleDisplay = $isAdmin
        ? 'Admin'
        : ($isDosen
            ? 'Dosen'
            : ($isMahasiswa ? 'Mahasiswa' : 'User'));
@endphp

<nav x-data="{ open: false }" class="bg-white/70 backdrop-blur-xl border-b border-white/40 shadow-md">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO -->
            <a href="{{ $dashboardHref }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-r from-emerald-700 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 .68 0 1.36-.09 2-.25V11.32c0-.69.18-1.35.48-1.93L12 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg text-slate-800 hidden sm:block">SIAKAD</span>
            </a>

            <!-- MENU -->
            <div class="hidden sm:flex items-center gap-2">

                <a href="{{ $dashboardHref }}"
                    class="px-4 py-2 text-sm font-medium rounded-xl transition-all
                    {{ $dashboardActive 
                        ? 'bg-emerald-100 text-emerald-700 shadow-sm' 
                        : 'text-slate-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                    Dashboard
                </a>

                @if($isAdmin)
                    <a href="{{ route('admin.mata-kuliah.index') }}"
                        class="px-4 py-2 text-sm rounded-xl {{ request()->routeIs('admin.mata-kuliah.*') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-emerald-50' }}">
                        Mata Kuliah
                    </a>
                    <a href="{{ route('admin.kelas.index') }}"
                        class="px-4 py-2 text-sm rounded-xl {{ request()->routeIs('admin.kelas.*') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-emerald-50' }}">
                        Kelas
                    </a>
                    <a href="{{ route('admin.mahasiswa.index') }}"
                        class="px-4 py-2 text-sm rounded-xl {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-emerald-50' }}">
                        Mahasiswa
                    </a>
                    <a href="{{ route('admin.dosen.index') }}"
                        class="px-4 py-2 text-sm rounded-xl {{ request()->routeIs('admin.dosen.*') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-emerald-50' }}">
                        Dosen
                    </a>
                @elseif($isMahasiswa)
                    <a href="{{ route('mahasiswa.krs.index') }}"
                        class="px-4 py-2 text-sm rounded-xl {{ request()->routeIs('mahasiswa.krs.*') ? 'bg-emerald-100 text-emerald-700' : 'hover:bg-emerald-50' }}">
                        KRS
                    </a>
                @endif

            </div>

            <!-- USER -->
            <div class="hidden sm:flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-4 py-2 bg-white/80 rounded-xl shadow">
                            <span class="text-sm">{{ $user->name }} </span>
                            <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full">
                                {{ $roleDisplay }}
                            </span>
                            ☰
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- HAMBURGER -->
            <div class="sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg hover:bg-emerald-50">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" class="sm:hidden bg-white/90 backdrop-blur border-t">
        <div class="p-4 space-y-2">

            <a href="{{ $dashboardHref }}" class="block px-4 py-2 rounded-lg hover:bg-emerald-50">
                Dashboard
            </a>

            @if($isMahasiswa)
                <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 rounded-lg hover:bg-emerald-50">
                    KRS
                </a>
            @endif

        </div>
    </div>

</nav>