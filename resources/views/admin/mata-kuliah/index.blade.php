<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332-.477-4.5-1.253">
                            </path>
                        </svg>
                    </div>
                    Mata Kuliah
                </h2>
                <p class="text-slate-600">{{ $mataKuliahs->total() }} mata kuliah tersedia</p>
            </div>

            <div class="flex gap-3 flex-wrap sm:flex-nowrap w-full sm:w-auto">
                <!-- Search -->
                <div class="relative w-full sm:w-72">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Cari mata kuliah..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-white/40 bg-white/60 backdrop-blur focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm shadow-sm">
                </div>

                <!-- Button -->
                <a href="{{ route('admin.mata-kuliah.create') }}"
                    class="whitespace-nowrap px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold shadow hover:shadow-lg hover:-translate-y-0.5 transition">
                    Tambah Mata Kuliah
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @include('admin.partials.flash')

        <div class="bg-white/60 backdrop-blur-xl shadow-sm sm:rounded-2xl border border-white/40 overflow-hidden">

            <!-- HEADER -->
            <div class="p-6 border-b border-white/40 bg-gradient-to-r from-white/40 to-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Daftar Mata Kuliah</h3>
                        <p class="text-sm text-slate-600 mt-1">Kelola data kurikulum dengan mudah</p>
                    </div>
                    <div class="text-sm text-slate-500">
                        {{ $mataKuliahs->firstItem() ?? 0 }} - {{ $mataKuliahs->lastItem() ?? 0 }}
                        dari {{ $mataKuliahs->total() }}
                    </div>
                </div>
            </div>
            
            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Kode</th>
                            <th class="px-6 py-3 text-left font-semibold">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left font-semibold">SKS</th>
                            <th class="px-6 py-3 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white/70">
                        @forelse ($mataKuliahs as $mk)
                            <tr class="hover:bg-emerald-50/60 transition">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs bg-emerald-100 text-emerald-800 px-3 py-1 rounded-lg font-semibold">
                                        {{ $mk->kode }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-medium text-slate-900">{{ $mk->nama }}</div>
                                            <div class="text-xs text-slate-500">ID: {{ $mk->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        {{ $mk->sks }} SKS
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.mata-kuliah.edit', $mk) }}"
                                            class="px-3 py-1.5 text-xs rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('admin.mata-kuliah.destroy', $mk) }}"
                                            onsubmit="return confirm('Hapus mata kuliah {{ $mk->nama }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-1.5 text-xs rounded-lg bg-rose-100 text-rose-700 hover:bg-rose-200 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-16 text-center">
                                    <p class="text-slate-500">Belum ada data</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if($mataKuliahs->hasPages())
                <div class="p-6 border-t border-white/30">
                    {{ $mataKuliahs->links() }}
                </div>
            @endif

        </div>

    </div>
</div>
</x-app-layout>