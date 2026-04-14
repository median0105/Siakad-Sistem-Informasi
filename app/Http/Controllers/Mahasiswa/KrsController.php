<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KrsController extends Controller
{
    public function index(Request $request): View
    {
        $mataKuliahId = $request->integer('mata_kuliah_id');

        $mataKuliahs = MataKuliah::query()
            ->orderBy('kode')
            ->get(['id', 'kode', 'nama', 'sks']);

        $kelasQuery = Kelas::query()
            ->with(['mataKuliah:id,kode,nama,sks', 'dosen:id,nama'])
            ->withCount('mahasiswa')
            ->orderByDesc('id');

        if ($mataKuliahId > 0) {
            $kelasQuery->where('mata_kuliah_id', $mataKuliahId);
        }

        $kelasTersedia = $kelasQuery->paginate(10)->withQueryString();

        $kelasDiambil = $request->user()
            ->kelasDiambil()
            ->with(['mataKuliah:id,kode,nama,sks', 'dosen:id,nama'])
            ->orderBy('mata_kuliah_id')
            ->get();

        $kelasDiambilIds = $kelasDiambil->pluck('id')->all();

        return view('mahasiswa.krs.index', [
            'mataKuliahs' => $mataKuliahs,
            'mataKuliahId' => $mataKuliahId,
            'kelasTersedia' => $kelasTersedia,
            'kelasDiambil' => $kelasDiambil,
            'kelasDiambilIds' => $kelasDiambilIds,
        ]);
    }

    public function store(Request $request, Kelas $kelas): RedirectResponse
    {
        $user = $request->user();

        $sudahAmbil = $user->kelasDiambil()->whereKey($kelas->id)->exists();
        if ($sudahAmbil) {
            return back()->with('status', 'Kelas sudah diambil.');
        }

        $terisi = $kelas->mahasiswa()->count();
        if ($kelas->kuota > 0 && $terisi >= $kelas->kuota) {
            return back()->withErrors(['kuota' => 'Kuota kelas sudah penuh.']);
        }

        try {
            $user->kelasDiambil()->attach($kelas->id);
        } catch (QueryException) {
            return back()->with('status', 'Kelas sudah diambil.');
        }

        return back()->with('status', 'Berhasil mengambil kelas.');
    }

    public function destroy(Request $request, Kelas $kelas): RedirectResponse
    {
        $request->user()->kelasDiambil()->detach($kelas->id);

        return back()->with('status', 'Kelas berhasil dibatalkan.');
    }
}
