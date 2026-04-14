<x-guest-layout>
    <div class="min-h-screen relative flex items-center justify-center px-6 py-12 overflow-hidden">

        <!-- BACKGROUND -->
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-emerald-50 via-white to-teal-50"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-300 opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-teal-300 opacity-30 rounded-full blur-3xl"></div>

        <!-- WRAPPER -->
        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

            <!-- LEFT CONTENT -->
            <div class="space-y-10">
                <div>
                    <span class="px-4 py-1 text-sm bg-emerald-100 text-emerald-700 rounded-full">
                        SISTEM AKADEMIK
                    </span>

                    <h1 class="mt-5 text-4xl font-bold text-slate-900 leading-tight">
                        Buat Akun Baru <br>
                        <span class="text-emerald-600">SIAKAD Modern</span>
                    </h1>

                    <p class="mt-4 text-slate-600 text-lg">
                        Daftar untuk mulai menggunakan sistem akademik secara mudah dan cepat.
                    </p>
                </div>

                <!-- INFO -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-white/70 backdrop-blur-xl border border-white/40 shadow-lg">
                        <div class="font-semibold text-slate-800">Akses Mudah</div>
                        <p class="text-sm text-slate-500 mt-1">
                            Login menggunakan Email atau NPM
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-white/70 backdrop-blur-xl border border-white/40 shadow-lg">
                        <div class="font-semibold text-slate-800">Terintegrasi</div>
                        <p class="text-sm text-slate-500 mt-1">
                            Data terhubung dengan sistem kampus
                        </p>
                    </div>
                </div>

                <!-- STATS -->
                <div class="flex gap-12 pt-4">
                    <div>
                        <div class="text-2xl font-bold text-emerald-600">1K+</div>
                        <div class="text-sm text-slate-500">Mahasiswa</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-purple-600">500+</div>
                        <div class="text-sm text-slate-500">Mata Kuliah</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-orange-500">200+</div>
                        <div class="text-sm text-slate-500">Kelas</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="flex justify-center">
                <div class="w-full max-w-md">

                    <!-- BORDER GLOW -->
                    <div class="p-[2px] rounded-3xl bg-gradient-to-r from-emerald-500 to-teal-500 shadow-2xl">

                        <!-- CARD -->
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden">

                            <!-- HEADER -->
                            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-7 text-center">
                                <h2 class="text-xl font-semibold">Daftar Akun</h2>
                                <p class="text-sm opacity-90 mt-1">
                                    Isi data untuk membuat akun
                                </p>
                            </div>

                            <!-- FORM -->
                            <div class="p-8 space-y-6">

                                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                                    @csrf

                                    <!-- NAME -->
                                    <div class="space-y-2">
                                        <x-input-label for="name" value="Nama Lengkap" />
                                        <x-text-input id="name"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3"
                                            type="text" name="name" :value="old('name')" required />
                                        <x-input-error :messages="$errors->get('name')" />
                                    </div>

                                    <!-- NPM -->
                                    <div class="space-y-2">
                                        <x-input-label for="npm" value="NPM" />
                                        <x-text-input id="npm"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3"
                                            type="text" name="npm" :value="old('npm')" required />
                                        <x-input-error :messages="$errors->get('npm')" />
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="space-y-2">
                                        <x-input-label for="email" value="Email" />
                                        <x-text-input id="email"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3"
                                            type="email" name="email" :value="old('email')" required />
                                        <x-input-error :messages="$errors->get('email')" />
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="space-y-2">
                                        <x-input-label for="password" value="Password" />
                                        <x-text-input id="password"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3"
                                            type="password" name="password" required />
                                        <x-input-error :messages="$errors->get('password')" />
                                    </div>

                                    <!-- CONFIRM -->
                                    <div class="space-y-2">
                                        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                        <x-text-input id="password_confirmation"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3"
                                            type="password" name="password_confirmation" required />
                                        <x-input-error :messages="$errors->get('password_confirmation')" />
                                    </div>

                                    <!-- ACTION -->
                                    <div class="flex items-center justify-between text-sm">
                                        <a href="{{ route('login') }}"
                                            class="text-emerald-600 hover:underline">
                                            Sudah punya akun?
                                        </a>
                                    </div>

                                    <!-- BUTTON -->
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold shadow hover:shadow-lg hover:-translate-y-0.5 transition">
                                        Register
                                    </button>

                                </form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-guest-layout>