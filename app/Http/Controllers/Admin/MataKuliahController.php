<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        $mataKuliahs = MataKuliah::query()
            ->orderBy('kode')
            ->paginate(10);

        return view('admin.mata-kuliah.index', [
            'mataKuliahs' => $mataKuliahs,
        ]);
    }

    public function create(): View
    {
        return view('admin.mata-kuliah.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:20', 'unique:mata_kuliahs,kode'],
            'nama' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'min:0', 'max:24'],
        ]);

        MataKuliah::create($data);

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('status', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        return view('admin.mata-kuliah.edit', [
            'mataKuliah' => $mataKuliah,
        ]);
    }

    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:20', Rule::unique('mata_kuliahs', 'kode')->ignore($mataKuliah->id)],
            'nama' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'min:0', 'max:24'],
        ]);

        $mataKuliah->update($data);

        return redirect()
            ->route('admin.mata-kuliah.index')
            ->with('status', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->delete();

        return back()->with('status', 'Mata kuliah berhasil dihapus.');
    }
}

