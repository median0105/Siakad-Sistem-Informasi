@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium tracking-wide text-slate-700']) }}>
    {{ $value ?? $slot }}
</label>
