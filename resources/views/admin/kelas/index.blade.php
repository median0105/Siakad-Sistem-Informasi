<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            
            <!-- LEFT -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 flex items-center justify-center shadow">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                        </svg>
                    </div>
                    Data Kelas
                </h2>
                <p class="text-slate-600 text-sm mt-1">
                    {{ $kelas->total() }} kelas tersedia
                </p>
            </div>

            <!-- RIGHT -->
            <div class="flex gap-3 flex-wrap sm:flex-nowrap w-full sm:w-auto">

                <!-- SEARCH -->
                <div class="relative w-full sm:w-72">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    <input type="text" placeholder="Cari kelas..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-white/40 bg-white/60 backdrop-blur focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
                </div>

                <!-- BUTTON -->
                <a href="{{ route('admin.kelas.create') }}"
                    class="whitespace-nowrap px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold shadow hover:shadow-lg hover:-translate-y-0.5 transition">
                    Tambah Kelas
                </a>
            </div>
        </div>
    </x-slot>

    <!-- CONTENT -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @include('admin.partials.flash')

            <!-- CARD -->
            <div class="bg-white/60 backdrop-blur-xl shadow-xl rounded-2xl border border-white/40 overflow-hidden">

                <!-- HEADER TABLE -->
                <div class="px-6 py-5 border-b border-white/40 bg-white/40">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-slate-900">Daftar Kelas</h3>
                            <p class="text-xs text-slate-500">
                                {{ $kelas->firstItem() ?? 0 }} - {{ $kelas->lastItem() ?? 0 }}
                                dari {{ $kelas->total() }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">

                        <thead class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Mata Kuliah</th>
                                <th class="px-6 py-3 text-left">Kelas</th>
                                <th class="px-6 py-3 text-left">Dosen</th>
                                <th class="px-6 py-3 text-left">Jadwal</th>
                                <th class="px-6 py-3 text-left">Ruangan</th>
                                <th class="px-6 py-3 text-left">Kuota</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white/70">
                            @forelse ($kelas as $item)
                                <tr class="hover:bg-emerald-50/60 transition">

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900">
                                            {{ $item->mataKuliah?->nama ?? '-' }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $item->mataKuliah?->kode ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-lg bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                            {{ $item->kode_kelas }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-slate-800">
                                        {{ $item->dosen?->nama ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-slate-900 text-sm">{{ $item->hari ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">
                                            {{ $item->jam_mulai ?? '-' }}
                                            {{ $item->jam_selesai ? ' - '.$item->jam_selesai : '' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-slate-800">
                                        {{ $item->ruangan ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                            {{ $item->mahasiswa_count ?? 0 }} / {{ $item->kuota ?: '∞' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('admin.kelas.edit', $item) }}"
                                                class="px-3 py-1.5 text-xs rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                action="{{ route('admin.kelas.destroy', $item) }}"
                                                onsubmit="return confirm('Hapus kelas {{ $item->kode_kelas }}?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-3 py-1.5 text-xs rounded-lg bg-rose-100 text-rose-700 hover:bg-rose-200">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-16 text-center">
                                        <div class="text-slate-500 space-y-3">
                                            <div class="text-3xl">🏫</div>
                                            <p class="font-medium">Belum ada kelas</p>
                                            <p class="text-sm">Tambahkan kelas pertama</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                @if($kelas->hasPages())
                    <div class="p-5 border-t border-white/40 bg-white/30">
                        {{ $kelas->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>