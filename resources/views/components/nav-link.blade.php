@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full border border-emerald-900/10 bg-emerald-950 px-4 py-2 text-sm font-medium text-white shadow-sm transition duration-200'
            : 'inline-flex items-center rounded-full border border-transparent px-4 py-2 text-sm font-medium text-slate-600 transition duration-200 hover:border-stone-200 hover:bg-white/70 hover:text-slate-950';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
