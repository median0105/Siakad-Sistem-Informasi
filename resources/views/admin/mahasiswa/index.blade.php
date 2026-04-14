<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <!-- LEFT -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center shadow">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        Data Mahasiswa
                    </h2>
                    <p class="text-slate-600 text-sm mt-1">
                        {{ $mahasiswas->total() }} mahasiswa terdaftar
                    </p>
                </div>

                <!-- RIGHT -->
                <div class="flex flex-wrap gap-3">

                    <!-- Search -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Cari mahasiswa..."
                            class="w-full sm:w-72 pl-11 pr-4 py-2.5 rounded-xl border border-white/40 bg-white/60 backdrop-blur focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition shadow-sm text-sm">
                    </div>

                    <!-- Button -->
                    <a href="{{ route('admin.mahasiswa.create') }}"
                        class="whitespace-nowrap px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold shadow hover:shadow-lg hover:-translate-y-0.5 transition">
                        Tambah Mahasiswa
                    </a>

                </div>
            </div>
        </div>
    </x-slot>

    <!-- CONTENT -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @include('admin.partials.flash')

            <div class="bg-white/60 backdrop-blur-xl rounded-3xl shadow-xl border border-white/40 overflow-hidden">

                <!-- HEADER TABLE -->
                <div class="p-6 border-b border-white/30 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-slate-900">Daftar Mahasiswa</h3>
                        <p class="text-sm text-slate-500">Kelola data mahasiswa</p>
                    </div>
                    <div class="text-sm text-slate-500">
                        {{ $mahasiswas->firstItem() ?? 0 }} - {{ $mahasiswas->lastItem() ?? 0 }}
                        dari {{ $mahasiswas->total() }}
                    </div>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">

                        <thead class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left">Mahasiswa</th>
                                <th class="px-6 py-3 text-left">NPM</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white/70">
                            @forelse ($mahasiswas as $mhs)
                                <tr class="hover:bg-emerald-50/50 transition">

                                    <!-- NAMA -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-gradient-to-r from-emerald-400 to-teal-500 flex items-center justify-center text-white text-sm font-bold">
                                                {{ strtoupper(substr($mhs->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900">{{ $mhs->name }}</div>
                                                <div class="text-xs text-slate-500">ID: {{ $mhs->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- NPM -->
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-lg">
                                            {{ $mhs->npm }}
                                        </span>
                                    </td>

                                    <!-- EMAIL -->
                                    <td class="px-6 py-4 text-slate-700">
                                        {{ $mhs->email }}
                                    </td>

                                    <!-- STATUS -->
                                    <td class="px-6 py-4">
                                        <span class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                            Aktif
                                        </span>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('admin.mahasiswa.edit', $mhs) }}"
                                                class="text-xs px-3 py-1.5 rounded-lg bg-purple-100 text-purple-700 hover:bg-purple-200 transition">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                action="{{ route('admin.mahasiswa.destroy', $mhs) }}"
                                                onsubmit="return confirm('Hapus mahasiswa {{ $mhs->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="text-xs px-3 py-1.5 rounded-lg bg-rose-100 text-rose-700 hover:bg-rose-200 transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-16 text-center text-slate-500">
                                        Belum ada data mahasiswa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                @if($mahasiswas->hasPages())
                    <div class="p-4 border-t border-white/30">
                        {{ $mahasiswas->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>