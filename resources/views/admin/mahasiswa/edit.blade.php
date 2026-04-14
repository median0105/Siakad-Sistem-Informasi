<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.mahasiswa.update', $user) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="Nama" />
                        <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="npm" value="NPM" />
                        <x-text-input id="npm" name="npm" class="mt-1 block w-full" :value="old('npm', $user->npm)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('npm')" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Password Baru (opsional)" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
                    </div>

                    <div class="flex gap-3">
                        <x-primary-button>Simpan</x-primary-button>
                        <a class="underline text-sm self-center" href="{{ route('admin.mahasiswa.index') }}">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
