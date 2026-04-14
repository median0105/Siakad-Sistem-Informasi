<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIAKAD - Sistem Informasi Akademik Modern') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-x-hidden">

    <!-- 🌈 GLOBAL BACKGROUND -->
    <div class="fixed inset-0 -z-10 bg-gradient-to-br from-slate-50 via-emerald-50 to-blue-50">
        
        <!-- Blob 1 -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>

        <!-- Blob 2 -->
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>

        <!-- Blob 3 -->
        <div class="absolute top-40 left-40 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-4000"></div>

    </div>

    {{-- NAVIGATION --}}
    <div class="relative z-50">
        @include('layouts.navigation')
    </div>

    @isset($header)
        <header class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white/60 backdrop-blur-xl shadow-lg rounded-2xl p-6 border border-white/40">
                {{ $header }}
            </div>
        </header>
    @endisset
    {{-- CONTENT --}}
    <main class="relative z-10">
        {{ $slot }}
    </main>

    @include('components.footer')

</body>

</html>