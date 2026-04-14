<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIAKAD - Sistem Informasi Akademik Modern') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- GLOBAL BACKGROUND -->
    <div class="fixed inset-0 -z-10 bg-gradient-to-br from-slate-50 via-emerald-50 to-blue-50"></div>

    <!-- CONTENT FULL WIDTH -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

</body>
</html>