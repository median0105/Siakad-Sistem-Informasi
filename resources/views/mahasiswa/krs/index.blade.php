<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ALERT --}}
            @if (session('status'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->has('kuota'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
                    {{ $errors->first('kuota') }}
                </div>
            @endif

            {{-- KELAS SAYA --}}
            <div class="bg-white/70 backdrop-blur-xl shadow-xl rounded-3xl border border-white/40 p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-4">Kelas Saya</h2>

                @if ($kelasDiambil->isEmpty())
                    <p class="text-sm text-slate-500">Belum ada kelas yang diambil.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-slate-500 border-b">
                                <tr>
                                    <th class="py-3">Mata Kuliah</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Jadwal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelasDiambil as $k)
                                    <tr class="border-b hover:bg-emerald-50/40 transition">
                                        <td class="py-3">
                                            <div class="font-semibold text-slate-800">
                                                {{ $k->mataKuliah?->kode }} - {{ $k->mataKuliah?->nama }}
                                            </div>
                                            <div class="text-xs text-slate-500">
                                                {{ $k->mataKuliah?->sks }} SKS
                                            </div>
                                        </td>
                                        <td>{{ $k->kode_kelas }}</td>
                                        <td>{{ $k->dosen?->nama ?? '-' }}</td>
                                        <td>
                                            <div>{{ $k->hari ?? '-' }}</div>
                                            <div class="text-xs text-slate-500">
                                                {{ $k->jam_mulai ? \Carbon\Carbon::parse($k->jam_mulai)->format('H:i') : '-' }}
                                                -
                                                {{ $k->jam_selesai ? \Carbon\Carbon::parse($k->jam_selesai)->format('H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <form method="POST" action="{{ route('mahasiswa.krs.destroy', $k) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1 text-xs rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- KELAS TERSEDIA --}}
            <div class="bg-white/70 backdrop-blur-xl shadow-xl rounded-3xl border border-white/40 p-6 space-y-4">

                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-lg font-bold text-slate-800">Kelas Tersedia</h2>

                    <form method="GET" action="{{ route('mahasiswa.krs.index') }}" class="flex gap-2">
                        <select name="mata_kuliah_id"
                            class="rounded-xl border-slate-200 text-sm focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                            <option value="">Semua</option>
                            @foreach ($mataKuliahs as $mk)
                                <option value="{{ $mk->id }}" @selected((int)$mataKuliahId === (int)$mk->id)>
                                    {{ $mk->kode }}
                                </option>
                            @endforeach
                        </select>

                        <button class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-xl shadow hover:bg-emerald-700 transition">
                            Filter
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-slate-500 border-b">
                            <tr>
                                <th class="py-3">Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Dosen</th>
                                <th>Jadwal</th>
                                <th>Kuota</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kelasTersedia as $k)
                                <tr class="border-b hover:bg-emerald-50/40 transition">
                                    <td class="py-3">
                                        <div class="font-semibold text-slate-800">
                                            {{ $k->mataKuliah?->kode }} - {{ $k->mataKuliah?->nama }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ $k->mataKuliah?->sks }} SKS
                                        </div>
                                    </td>

                                    <td>{{ $k->kode_kelas }}</td>
                                    <td>{{ $k->dosen?->nama ?? '-' }}</td>

                                    <td>
                                        <div>{{ $k->hari ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">
                                            {{ $k->jam_mulai ? \Carbon\Carbon::parse($k->jam_mulai)->format('H:i') : '-' }}
                                            -
                                            {{ $k->jam_selesai ? \Carbon\Carbon::parse($k->jam_selesai)->format('H:i') : '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-xs px-2 py-1 rounded-lg bg-slate-100 text-slate-600">
                                            {{ $k->mahasiswa_count }} / {{ $k->kuota ?: '∞' }}
                                        </span>
                                    </td>

                                    <td class="text-right">
                                        @if (in_array($k->id, $kelasDiambilIds, true))
                                            <span class="text-xs px-3 py-1 rounded-lg bg-emerald-100 text-emerald-700">
                                                Diambil
                                            </span>
                                        @else
                                            <form method="POST" action="{{ route('mahasiswa.krs.store', $k) }}">
                                                @csrf
                                                <button class="px-4 py-1.5 text-xs bg-emerald-600 text-white rounded-xl shadow hover:bg-emerald-700 transition">
                                                    Ambil
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-slate-500">
                                        Tidak ada kelas tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $kelasTersedia->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>