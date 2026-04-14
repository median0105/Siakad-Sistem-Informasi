@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-2xl border border-stone-300/90 bg-white/90 px-4 py-3 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500']) }}>
