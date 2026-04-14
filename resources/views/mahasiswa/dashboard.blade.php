<x-app-layout>
    <div class="relative py-12 overflow-hidden">

        {{-- Background Blur ala Welcome --}}
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 right-0 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply blur-2xl opacity-50 animate-blob"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply blur-2xl opacity-50 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- HERO --}}
            <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl p-8">
                <div class="flex flex-col lg:flex-row justify-between gap-6">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Halo, {{ auth()->user()->name }}
                        </h1>
                        <p class="text-gray-600 mt-2">
                            Kelola KRS dan pantau aktivitas akademik Anda dengan mudah.
                        </p>
                    </div>

                    <div class="bg-white/80 backdrop-blur rounded-2xl p-5 shadow">
                        <div class="text-sm text-gray-500">Identitas</div>
                        <div class="mt-2 text-sm">
                            <div><span class="font-medium">NPM:</span> {{ auth()->user()->npm ?? '-' }}</div>
                            <div><span class="font-medium">Nama:</span> {{ auth()->user()->name  ?? '-' }}</div>
                            <div>{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- DATA --}}
            @php
                $userId = auth()->id();
                $enrolledCount = \App\Models\Enrollment::where('user_id', $userId)->count();
                $availableKelas = \App\Models\Kelas::whereDoesntHave('mahasiswa', fn($q) => $q->where('user_id', $userId))->count();
                $kelasCount = \App\Models\Kelas::count();
            @endphp

            {{-- STATS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl rounded-3xl p-6 hover:scale-[1.02] transition">
                    <p class="text-sm text-gray-600">Kelas Terdaftar</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $enrolledCount }}</p>
                    <a href="{{ route('mahasiswa.krs.index') }}" class="text-emerald-600 text-sm mt-2 inline-block">
                        Lihat KRS →
                    </a>
                </div>

                <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl rounded-3xl p-6">
                    <p class="text-sm text-gray-600">Kelas Tersedia</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $availableKelas }}</p>
                </div>

                <div class="bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl rounded-3xl p-6">
                    <p class="text-sm text-gray-600">Total Kelas</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $kelasCount }}</p>
                </div>

            </div>

            {{-- CTA --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-3xl p-10 text-center shadow-2xl">
                <h2 class="text-2xl font-bold mb-3">Mulai Ambil Kelas</h2>
                <p class="mb-6 opacity-90">Akses KRS dan pilih kelas sesuai kebutuhan Anda</p>

                <a href="{{ route('mahasiswa.krs.index') }}"
                   class="inline-block bg-white text-emerald-600 px-6 py-3 rounded-2xl font-semibold shadow hover:scale-105 transition">
                    Buka KRS
                </a>
            </div>

        </div>

        {{-- Animasi --}}
        <style>
            .animate-blob {
                animation: blob 7s infinite;
            }
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animation-delay-2000 { animation-delay: 2s; }
        </style>

    </div>
</x-app-layout>