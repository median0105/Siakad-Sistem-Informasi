<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KelasController extends Controller
{
    public function index(): View
    {
        $kelas = Kelas::query()
            ->with(['mataKuliah:id,kode,nama', 'dosen:id,nama'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.kelas.index', [
            'kelas' => $kelas,
        ]);
    }

    public function create(): View
    {
        return view('admin.kelas.create', [
            'mataKuliahs' => MataKuliah::query()->orderBy('kode')->get(['id', 'kode', 'nama']),
            'dosens' => Dosen::query()->orderBy('nama')->get(['id', 'nama']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Kelas::create($data);

        return redirect()
            ->route('admin.kelas.index')
            ->with('status', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela): View
    {
        return view('admin.kelas.edit', [
            'kela' => $kela,
            'mataKuliahs' => MataKuliah::query()->orderBy('kode')->get(['id', 'kode', 'nama']),
            'dosens' => Dosen::query()->orderBy('nama')->get(['id', 'nama']),
        ]);
    }

    public function update(Request $request, Kelas $kela): RedirectResponse
    {
        $data = $this->validated($request, $kela);

        $kela->update($data);

        return redirect()
            ->route('admin.kelas.index')
            ->with('status', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela): RedirectResponse
    {
        $kela->delete();

        return back()->with('status', 'Kelas berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Kelas $kelas = null): array
    {
        $uniqueKelas = Rule::unique('kelas', 'kode_kelas')
            ->where(fn ($q) => $q->where('mata_kuliah_id', $request->input('mata_kuliah_id')));

        if ($kelas) {
            $uniqueKelas = $uniqueKelas->ignore($kelas->id);
        }

        return $request->validate([
            'mata_kuliah_id' => ['required', 'integer', 'exists:mata_kuliahs,id'],
            'dosen_id' => ['nullable', 'integer', 'exists:dosens,id'],
            'kode_kelas' => ['required', 'string', 'max:20', $uniqueKelas],
            'hari' => ['nullable', 'string', 'max:20'],
            'jam_mulai' => ['nullable', 'date_format:H:i'],
            'jam_selesai' => ['nullable', 'date_format:H:i'],
            'ruangan' => ['nullable', 'string', 'max:50'],
            'kuota' => ['required', 'integer', 'min:0', 'max:1000'],
        ]);
    }
}

