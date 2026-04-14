<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mata Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.mata-kuliah.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="kode" value="Kode" />
                        <x-text-input id="kode" name="kode" class="mt-1 block w-full" :value="old('kode')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('kode')" />
                    </div>

                    <div>
                        <x-input-label for="nama" value="Nama" />
                        <x-text-input id="nama" name="nama" class="mt-1 block w-full" :value="old('nama')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <div>
                        <x-input-label for="sks" value="SKS" />
                        <x-text-input id="sks" name="sks" type="number" min="0" max="24" class="mt-1 block w-full" :value="old('sks', 0)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('sks')" />
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Simpan</x-primary-button>
                        <a class="underline text-sm self-center" href="{{ route('admin.mata-kuliah.index') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

