<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD - Sistem Informasi Akademik Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-x-hidden">
    <div class="relative min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-blue-50">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
            </div>
            <div
                class="absolute top-40 left-40 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-40 pt-8 lg:pt-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-14 h-14 bg-gradient-to-r from-emerald-950 to-teal-900 rounded-2xl flex items-center justify-center shadow-2xl">
                            <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 .68 0 1.36-.09 2-.25V11.32c0-.69.18-1.35.48-1.93L12 2zM15.77 13.12c.14.27.21.58.21.9v5.43c-1.1.13-2.18.47-3.2.92-.76.32-1.56.76-2.35 1.33V11.7l3.34 1.42zM12 9.55L17 7l-5-2-5 2 5 2.13z" />
                            </svg>
                        </div>
                        <div class="hidden lg:block">
                            <h1
                                class="text-2xl font-bold bg-gradient-to-r from-slate-950 to-slate-900 bg-clip-text text-transparent">
                                SIAKAD</h1>
                            <p class="text-sm text-emerald-700 font-medium">Sistem Informasi Akademik</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center px-6 py-3 rounded-2xl bg-white/80 backdrop-blur-sm border border-slate-200 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-slate-900 font-semibold text-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-6 py-3 rounded-2xl border-2 border-emerald-600 text-emerald-600 font-semibold text-sm hover:bg-emerald-50 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative z-20 py-24 lg:py-32">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="max-w-4xl mx-auto">
                    {{-- <div
                        class="inline-flex items-center gap-3 bg-emerald-100/80 px-6 py-3 rounded-3xl backdrop-blur-sm mb-8">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full animate-ping"></div>
                        <span class="text-sm font-semibold text-emerald-800">Sistem Akademik Modern &
                            Terintegrasi</span>
                    </div> --}}
                    <h1
                        class="text-5xl lg:text-7xl font-bold bg-gradient-to-r from-slate-950 via-gray-900 to-slate-900 bg-clip-text text-transparent mb-8 leading-tight">
                        Kelola Akademik
                        <span
                            class="block bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Dengan
                            Mudah</span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-600 max-w-2xl mx-auto mb-12 leading-relaxed">
                        Platform lengkap untuk manajemen mata kuliah, dosen, mahasiswa, KRS, dan jadwal kuliah.
                        <span class="font-semibold text-emerald-700">Modern, cepat, dan aman.</span>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-2xl mx-auto">
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto flex items-center justify-center gap-3 px-10 py-5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-lg rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Mulai Sekarang
                        </a>
                        <a href="#fitur"
                            class="w-full sm:w-auto px-10 py-5 border-2 border-emerald-600 text-emerald-600 font-bold text-lg rounded-3xl hover:bg-emerald-50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            Lihat Fitur
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="fitur" class="relative z-20 py-32 lg:py-40 -mt-20 lg:mt-0">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-24">
                    <h2
                        class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent mb-6">
                        Fitur Lengkap Akademik
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Kelola semua aspek akademik dalam satu platform modern dan intuitif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="group relative p-10 rounded-3xl bg-white/70 backdrop-blur-sm border border-white/50 shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-700 cursor-pointer">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-2xl mb-8 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332 .477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332 .477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332-.477-4.5-1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Mata Kuliah</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Kelola kurikulum, SKS, dan jadwal mata
                            kuliah dengan mudah.</p>
                    </div>

                    <div
                        class="group relative p-10 rounded-3xl bg-white/70 backdrop-blur-sm border border-white/50 shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-700 cursor-pointer">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-2xl mb-8 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Mahasiswa</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Daftar mahasiswa, profil, dan progress
                            akademik terpusat.</p>
                    </div>

                    <div
                        class="group relative p-10 rounded-3xl bg-white/70 backdrop-blur-sm border border-white/50 shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-700 cursor-pointer">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-500/10 to-red-500/10 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-2xl mb-8 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m-1 4h1m-1-4-4 4 4-4zm7 0h1m-1 4h1m-1 4h1m-1-4-4 4 4-4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Jadwal Kelas</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Penjadwalan otomatis, ruangan, kuota, dan
                            monitoring penuh.</p>
                    </div>

                    <div
                        class="group relative p-10 rounded-3xl bg-white/70 backdrop-blur-sm border border-white/50 shadow-2xl hover:shadow-3xl hover:-translate-y-4 transition-all duration-700 cursor-pointer">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-indigo-500/10 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-2xl mb-8 group-hover:scale-110 transition-transform duration-500 mx-auto">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707 .293l5.414 5.414a1 1 0 01 .293 .707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">KRS Online</h3>
                        <p class="text-gray-600 text-center leading-relaxed">KRS mandiri mahasiswa, validasi otomatis,
                            monitoring real-time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Bottom -->
        <section class="relative z-20 py-24 bg-gradient-to-r from-emerald-600/10 to-teal-600/10">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Siap Kelola Akademik Modern?
                </h2>
                <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                    Mulai sekarang dengan platform SIAKAD yang powerful dan mudah digunakan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-12 py-6 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold text-xl rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500">
                        Mulai Gratis
                    </a>
                    <a href="#fitur"
                        class="inline-flex items-center justify-center px-12 py-6 border-4 border-emerald-600 text-emerald-600 font-bold text-xl rounded-3xl hover:bg-emerald-600 hover:text-white transition-all duration-500 shadow-xl hover:shadow-2xl hover:-translate-y-2">
                        Fitur Lengkap
                    </a>
                </div>
            </div>
        </section>

        <!-- Animation CSS -->
        <style>
            .animate-blob {
                animation: blob 7s infinite;
            }

            @keyframes blob {
                0% {
                    transform: translate(0px, 0px) scale(1);
                }

                33% {
                    transform: translate(30px, -50px) scale(1.1);
                }

                66% {
                    transform: translate(-20px, 20px) scale(0.9);
                }

                100% {
                    transform: translate(0px, 0px) scale(1);
                }
            }

            .animation-delay-2000 {
                animation-delay: 2s;
            }

            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>

        {{-- FIXED FOOTER --}}
        @include('components.footer')
    </div>
</body>
</html>