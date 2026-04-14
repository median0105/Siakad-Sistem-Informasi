<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = User::query()
            ->where('role', UserRole::Mahasiswa)
            ->orderBy('npm')
            ->paginate(10);

        return view('admin.mahasiswa.index', [
            'mahasiswas' => $mahasiswas,
        ]);
    }

    public function create(): View
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z0-9]+$/', 'unique:users,npm'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $data['name'],
            'npm' => $data['npm'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRole::Mahasiswa,
        ]);

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('status', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        abort_unless($user->role === UserRole::Mahasiswa, 404);

        return view('admin.mahasiswa.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless($user->role === UserRole::Mahasiswa, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z0-9]+$/', Rule::unique('users', 'npm')->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $data['name'];
        $user->npm = $data['npm'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('status', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless($user->role === UserRole::Mahasiswa, 404);

        $user->delete();

        return back()->with('status', 'Mahasiswa berhasil dihapus.');
    }
}
