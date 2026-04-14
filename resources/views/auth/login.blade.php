<x-guest-layout>
    <!-- BACKGROUND -->
    <div class="min-h-screen relative flex items-center justify-center px-6 py-12 overflow-hidden">

        <!-- Gradient Background -->
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-emerald-50 via-white to-teal-50"></div>

        <!-- Blur Circle -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-300 opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-teal-300 opacity-30 rounded-full blur-3xl"></div>

        <!-- WRAPPER -->
        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

            <!-- LEFT -->
            <div class="space-y-10">
                <div>
                    <span class="px-4 py-1 text-sm bg-emerald-100 text-emerald-700 rounded-full">
                        SISTEM AKADEMIK
                    </span>

                    <h1 class="mt-5 text-4xl font-bold text-slate-900 leading-tight">
                        Selamat Datang <br>
                        <span class="text-emerald-600">SIAKAD Modern</span>
                    </h1>

                    <p class="mt-4 text-slate-600 text-lg">
                        Platform akademik lengkap untuk <b>login & registrasi</b> aman dan cepat.
                    </p>
                </div>

                <!-- FEATURES -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-white/70 backdrop-blur-xl border border-white/40 shadow-lg">
                        <div class="font-semibold text-slate-800">Keamanan Tinggi</div>
                        <p class="text-sm text-slate-500 mt-1">
                            Enkripsi data dan autentikasi modern
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-white/70 backdrop-blur-xl border border-white/40 shadow-lg">
                        <div class="font-semibold text-slate-800">Role Based</div>
                        <p class="text-sm text-slate-500 mt-1">
                            Admin, Dosen, Mahasiswa
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

            <!-- RIGHT LOGIN -->
            <div class="flex justify-center">
                <div class="w-full max-w-md">

                    <!-- OUTER WRAPPER (BIAR MODERN) -->
                    <div class="p-[2px] rounded-3xl bg-gradient-to-r from-emerald-500 to-teal-500 shadow-2xl">

                        <!-- CARD -->
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden">

                            <!-- HEADER -->
                            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-7 text-center">
                                <h2 class="text-xl font-semibold">Selamat Datang </h2>
                                <p class="text-sm opacity-90 mt-1">
                                    Masuk ke akun anda
                                </p>
                            </div>

                            <!-- FORM -->
                            <div class="p-8 space-y-6">

                                <x-auth-session-status :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                    @csrf

                                    <!-- LOGIN -->
                                    <div class="space-y-2">
                                        <x-input-label for="login" value="Email atau NPM" />
                                        <x-text-input id="login"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                            type="text"
                                            name="login"
                                            :value="old('login')"
                                            required />
                                        <x-input-error :messages="$errors->get('login')" />
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="space-y-2">
                                        <x-input-label for="password" value="Password" />
                                        <x-text-input id="password"
                                            class="w-full rounded-xl border border-gray-200 px-4 py-3 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                                            type="password"
                                            name="password"
                                            required />
                                        <x-input-error :messages="$errors->get('password')" />
                                    </div>

                                    <!-- OPTIONS -->
                                    <div class="flex items-center justify-between text-sm">
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="remember"
                                                class="rounded border-gray-300 text-emerald-600">
                                            <span class="text-slate-600">Remember me</span>
                                        </label>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-emerald-600 hover:underline">
                                                Lupa password?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- BUTTON -->
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold shadow hover:shadow-lg hover:-translate-y-0.5 transition">
                                        Login
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