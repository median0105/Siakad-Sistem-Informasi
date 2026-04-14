<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        $dosen = Dosen::query()
            ->where('email', $user->email)
            ->first();

        $kelas = collect();
        $stats = [
            'jumlah_kelas' => 0,
            'total_mahasiswa' => 0,
            'mata_kuliah' => 0,
        ];

        if ($dosen) {
            $kelas = Kelas::query()
                ->with(['mataKuliah:id,kode,nama'])
                ->withCount('mahasiswa')
                ->where('dosen_id', $dosen->id)
                ->orderBy('hari')
                ->orderBy('jam_mulai')
                ->get();

            $stats = [
                'jumlah_kelas' => $kelas->count(),
                'total_mahasiswa' => $kelas->sum('mahasiswa_count'),
                'mata_kuliah' => $kelas->pluck('mata_kuliah_id')->filter()->unique()->count(),
            ];
        }

        return view('dosen.dashboard', [
            'dosen' => $dosen,
            'kelas' => $kelas,
            'stats' => $stats,
        ]);
    }
}
