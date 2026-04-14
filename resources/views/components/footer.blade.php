<footer class="relative z-20 bg-white/80 backdrop-blur-md border-t border-slate-200 mt-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- BRAND -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-700 to-teal-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 .68 0 1.36-.09 2-.25V11.32c0-.69.18-1.35.48-1.93L12 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-slate-800">SIAKAD</span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Sistem Informasi Akademik modern untuk memudahkan pengelolaan data mahasiswa,
                    dosen, dan KRS secara terintegrasi.
                </p>
            </div>

            <!-- MENU -->
            <div>
                <h3 class="font-semibold text-slate-800 mb-4">Menu</h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li><a href="#" class="hover:text-emerald-600 transition">Dashboard</a></li>
                    <li><a href="#" class="hover:text-emerald-600 transition">KRS</a></li>
                    <li><a href="#" class="hover:text-emerald-600 transition">Mata Kuliah</a></li>
                </ul>
            </div>

            <!-- INFO -->
            <div>
                <h3 class="font-semibold text-slate-800 mb-4">Informasi</h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>Email: mediansory01@gmail.com</li>
                    <li>Telp: +62 857-6995-9241</li>
                    <li>Bengkulu, Indonesia</li>
                </ul>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="mt-12 border-t border-slate-200 pt-6 text-center text-sm text-slate-500">
            © {{ date('Y') }} SIAKAD. All rights reserved.
        </div>

    </div>
</footer>