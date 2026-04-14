<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\RedirectResponse;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View
    {
        $dosens = Dosen::query()
            ->orderBy('nama')
            ->paginate(10);

        return view('admin.dosen.index', [
            'dosens' => $dosens,
        ]);
    }

    public function create(): View
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nidn' => ['nullable', 'string', 'max:50', 'unique:dosens,nidn'],
            'email' => ['nullable', 'email', 'max:255', 'unique:dosens,email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $dosen = Dosen::create([
            'nama' => $data['nama'],
            'nidn' => $data['nidn'],
            'email' => $data['email'],
        ]);

        User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRole::Dosen,
        ]);

        return redirect()
            ->route('admin.dosen.index')
            ->with('status', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen): View
    {
        return view('admin.dosen.edit', [
            'dosen' => $dosen,
        ]);
    }

    public function update(Request $request, Dosen $dosen): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nidn' => ['nullable', 'string', 'max:50', Rule::unique('dosens', 'nidn')->ignore($dosen->id)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('dosens', 'email')->ignore($dosen->id), Rule::unique('users', 'email')->ignore($dosen->user?->id ?? 0)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $dosen->update([
            'nama' => $data['nama'],
            'nidn' => $data['nidn'],
            'email' => $data['email'],
        ]);

        $user = User::where('email', $data['email'])->where('role', UserRole::Dosen)->first();
        if ($user && !empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        return redirect()
            ->route('admin.dosen.index')
            ->with('status', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen): RedirectResponse
    {
        $dosen->delete();

        return back()->with('status', 'Dosen berhasil dihapus.');
    }
}

