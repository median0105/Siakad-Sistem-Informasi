<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Enrollment;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'mata_kuliah' => MataKuliah::count(),
            'dosen' => Dosen::count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'kelas' => Kelas::count(),
            'enrollments' => Enrollment::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

