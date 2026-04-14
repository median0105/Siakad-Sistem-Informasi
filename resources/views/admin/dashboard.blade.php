<x-app-layout>

    <div class="relative min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-blue-50 py-10">

        <!-- FLOATING BLOB -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-200 rounded-full blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-200 rounded-full blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- HERO -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start shadow-2xl bg-white/70 backdrop-blur-xl border border-white/50 rounded-3xl p-8">
                <div class="lg:col-span-2 space-y-4">
                    <div class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-sm font-semibold">
                        Admin Panel
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold text-slate-900">
                        Selamat Datang, {{ auth()->user()->name }}
                    </h1>

                    <p class="text-slate-600 text-lg">
                        Kelola sistem akademik dengan tampilan modern, cepat, dan efisien.
                    </p>
                </div>

                <!-- PROFILE CARD -->
                <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-5 shadow-lg border border-white/50">
                    <p class="text-sm text-slate-500 mb-2">Akun Aktif</p>
                    <p class="font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-slate-500">{{ auth()->user()->email }}</p>

                    <span class="inline-block mt-3 text-xs bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full">
                        Administrator
                    </span>
                </div>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach ([
                    ['label' => 'Mata Kuliah', 'key' => 'mata_kuliah'],
                    ['label' => 'Dosen', 'key' => 'dosen'],
                    ['label' => 'Mahasiswa', 'key' => 'mahasiswa'],
                    ['label' => 'Kelas', 'key' => 'kelas'],
                ] as $item)

                    <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/50 hover:-translate-y-2 hover:shadow-xl transition-all">

                        <p class="text-sm text-slate-500">{{ $item['label'] }}</p>

                        <p class="text-3xl font-bold text-slate-900 mt-2">
                            {{ $stats[$item['key']] ?? 0 }}
                        </p>

                        <div class="mt-3 h-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full"></div>

                    </div>

                @endforeach

            </div>

            <!-- CHART & ENROLLMENT -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- CHART -->
                <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/50">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Statistik Akademik</h3>
                    <div class="h-64">
                        <canvas id="statsChart"></canvas>
                    </div>
                </div>

                <!-- ENROLLMENT -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-2xl p-6 shadow-lg flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Pendaftaran</h3>
                        <p class="text-4xl font-bold mt-3">
                            {{ $stats['enrollments'] ?? 0 }}
                        </p>
                        <p class="text-sm opacity-80 mt-2">Mahasiswa terdaftar</p>
                    </div>
                </div>

            </div>

            <!-- QUICK ACTION -->
            <div class="bg-white/70 backdrop-blur-xl rounded-2xl p-6 shadow-lg border border-white/50">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Quick Actions</h3>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('admin.mata-kuliah.create') }}"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold shadow hover:shadow-lg hover:-translate-y-1 transition">
                        + Mata Kuliah
                    </a>

                    <a href="{{ route('admin.dosen.create') }}"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow hover:shadow-lg hover:-translate-y-1 transition">
                        + Dosen
                    </a>

                    <a href="{{ route('admin.kelas.create') }}"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold shadow hover:shadow-lg hover:-translate-y-1 transition">
                        + Kelas
                    </a>
                </div>
            </div>
        </div>

        <!-- ANIMATION -->
        <style>
            .animate-blob {
                animation: blob 7s infinite;
            }
            @keyframes blob {
                0% { transform: translate(0,0) scale(1); }
                33% { transform: translate(30px,-50px) scale(1.1); }
                66% { transform: translate(-20px,20px) scale(0.9); }
                100% { transform: translate(0,0) scale(1); }
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
        </style>

    </div>

    <!-- CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('statsChart')?.getContext('2d');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Mata Kuliah', 'Dosen', 'Mahasiswa', 'Kelas'],
                        datasets: [{
                            data: [
                                {{ $stats['mata_kuliah'] ?? 0 }},
                                {{ $stats['dosen'] ?? 0 }},
                                {{ $stats['mahasiswa'] ?? 0 }},
                                {{ $stats['kelas'] ?? 0 }}
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        });
    </script>
</x-app-layout>