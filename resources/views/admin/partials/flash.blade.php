@if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
        {{ session('status') }}
    </div>
@endif

