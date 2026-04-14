<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Dosen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 bg-gradient-to-r from-amber-50 via-white to-orange-50 overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div class="space-y-2">
                                <div class="text-sm font-medium uppercase tracking-[0.2em] text-amber-700">Panel Dosen</div>
                                <h3 class="text-2xl font-semibold text-gray-900">Selamat datang, {{ auth()->user()->name }}</h3>
                                <p class="text-sm text-gray-600">
                                    Pantau jadwal mengajar, mata kuliah aktif, dan jumlah mahasiswa dari satu halaman.
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white/80 px-4 py-3 shadow-sm ring-1 ring-amber-100">
                                <div class="text-xs uppercase tracking-[0.2em] text-gray-500">Identitas</div>
                                <div class="mt-2 text-sm text-gray-700">Email: {{ auth()->user()->email }}</div>
                                <div class="text-sm text-gray-700">NIDN: {{ $dosen?->nidn ?: '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500">Status Akun</div>
                        @if ($dosen)
                            <div class="mt-3 inline-flex rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-700">
                                Terhubung ke data dosen
                            </div>
                            <p class="mt-3 text-sm text-gray-600">
                                Akun ini sudah terhubung dengan profil dosen atas nama <span class="font-medium text-gray-900">{{ $dosen->nama }}</span>.
                            </p>
                        @else
                            <div class="mt-3 inline-flex rounded-full bg-amber-100 px-3 py-1 text-sm font-medium text-amber-700">
                                Profil dosen belum terhubung
                            </div>
                            <p class="mt-3 text-sm text-gray-600">
                                Email login belum cocok dengan data pada tabel dosen, jadi data jadwal belum bisa ditampilkan penuh.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Kelas Diampu</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['jumlah_kelas'] }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Mata Kuliah Aktif</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['mata_kuliah'] }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="text-sm text-gray-500">Total Mahasiswa</div>
                        <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_mahasiswa'] }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Jadwal Mengajar</h3>
                            <p class="text-sm text-gray-600">Daftar kelas yang saat ini terhubung dengan akun dosen Anda.</p>
                        </div>
                    </div>

                    @if ($kelas->isEmpty())
                        <div class="mt-6 rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-10 text-center">
                            <div class="text-base font-medium text-gray-900">Belum ada kelas yang ditampilkan</div>
                            <p class="mt-2 text-sm text-gray-600">
                                Pastikan data dosen sudah dipilih pada menu kelas agar jadwal mengajar muncul di dashboard ini.
                            </p>
                        </div>
                    @else
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Mata Kuliah</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Kelas</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Hari</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Jam</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Ruangan</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-600">Mahasiswa</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach ($kelas as $item)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-900">{{ $item->mataKuliah?->nama ?? '-' }}</div>
                                                <div class="text-xs text-gray-500">{{ $item->mataKuliah?->kode ?? '-' }}</div>
                                            </td>
                                            <td class="px-4 py-3 text-gray-700">{{ $item->kode_kelas }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $item->hari ?: '-' }}</td>
                                            <td class="px-4 py-3 text-gray-700">
                                                {{ $item->jam_mulai ?: '-' }}{{ $item->jam_selesai ? ' - '.$item->jam_selesai : '' }}
                                            </td>
                                            <td class="px-4 py-3 text-gray-700">{{ $item->ruangan ?: '-' }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $item->mahasiswa_count }} / {{ $item->kuota ?: '∞' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
