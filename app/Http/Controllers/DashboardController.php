<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        return match ($user->role) {
            UserRole::Admin => redirect()->route('admin.dashboard'),
            UserRole::Dosen => redirect()->route('dosen.dashboard'),
            UserRole::Mahasiswa => redirect()->route('mahasiswa.dashboard'),
            default => redirect()->route('profile.edit'),
        };
    }
}
