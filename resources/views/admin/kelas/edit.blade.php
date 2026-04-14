<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kelas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.kelas.update', $kela) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
                        <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="">Pilih mata kuliah</option>
                            @foreach ($mataKuliahs as $mataKuliah)
                                <option value="{{ $mataKuliah->id }}" @selected(old('mata_kuliah_id', $kela->mata_kuliah_id) == $mataKuliah->id)>
                                    {{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('mata_kuliah_id')" />
                    </div>

                    <div>
                        <x-input-label for="dosen_id" value="Dosen (opsional)" />
                        <select id="dosen_id" name="dosen_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Pilih dosen</option>
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->id }}" @selected(old('dosen_id', $kela->dosen_id) == $dosen->id)>
                                    {{ $dosen->nama }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('dosen_id')" />
                    </div>

                    <div>
                        <x-input-label for="kode_kelas" value="Kode Kelas" />
                        <x-text-input id="kode_kelas" name="kode_kelas" class="mt-1 block w-full" :value="old('kode_kelas', $kela->kode_kelas)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('kode_kelas')" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        <div>
                            <x-input-label for="hari" value="Hari" />
                            <x-text-input id="hari" name="hari" class="mt-1 block w-full" :value="old('hari', $kela->hari)" />
                            <x-input-error class="mt-2" :messages="$errors->get('hari')" />
                        </div>

                        <div>
                            <x-input-label for="jam_mulai" value="Jam Mulai" />
                            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full" :value="old('jam_mulai', $kela->jam_mulai)" />
                            <x-input-error class="mt-2" :messages="$errors->get('jam_mulai')" />
                        </div>

                        <div>
                            <x-input-label for="jam_selesai" value="Jam Selesai" />
                            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full" :value="old('jam_selesai', $kela->jam_selesai)" />
                            <x-input-error class="mt-2" :messages="$errors->get('jam_selesai')" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <x-input-label for="ruangan" value="Ruangan" />
                            <x-text-input id="ruangan" name="ruangan" class="mt-1 block w-full" :value="old('ruangan', $kela->ruangan)" />
                            <x-input-error class="mt-2" :messages="$errors->get('ruangan')" />
                        </div>

                        <div>
                            <x-input-label for="kuota" value="Kuota" />
                            <x-text-input id="kuota" name="kuota" type="number" min="0" max="1000" class="mt-1 block w-full" :value="old('kuota', $kela->kuota)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kuota')" />
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Simpan</x-primary-button>
                        <a class="underline text-sm self-center" href="{{ route('admin.kelas.index') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
