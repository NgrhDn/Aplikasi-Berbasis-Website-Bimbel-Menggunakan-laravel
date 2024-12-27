<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Melihat semua pengguna
    public function index(Request $request)
    {
        // Ambil jenis role dari request (filter)
        $roleFilter = $request->query('role');

        // Query pengguna dengan role
        $query = User::with('role');

        if ($roleFilter) {
            $query->whereHas('role', function ($q) use ($roleFilter) {
                $q->where('name', $roleFilter);
            });
        }

        $users = $query->get();

        // Ambil daftar role unik untuk filter dropdown
        $roles = Role::whereIn('name', ['admin', 'pengajar', 'siswa'])->get();

        return view('admin.users.index', compact('users', 'roles', 'roleFilter'));
    }


    // Form untuk membuat pengguna baru
    public function create()
    {
        // Hanya mengambil role "siswa" dan "pengajar"
        $roles = Role::whereIn('name', ['siswa', 'pengajar'])->get();
        return view('admin.users.create', compact('roles'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'kelas' => 'nullable|string|max:255',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'kelas' => $request->kelas, // Jika ada kelas untuk siswa
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dibuat.');
    }



    // Form untuk mengedit pengguna
    public function edit($id)
    {
        // Mengambil data pengguna dan daftar role
        $user = User::findOrFail($id);
        $roles = Role::whereIn('name', ['siswa', 'pengajar'])->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        // Mengambil pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'kelas' => 'nullable|string|max:255', // Validasi kelas (opsional)
            'password' => 'nullable|string|min:6', // Password bersifat opsional
        ]);

        // Update data pengguna
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'kelas' => $request->kelas, // Update kolom kelas
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        // Menghapus pengguna berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

        // Form tambah pengajar
     public function createPengajar()
        {
            $role = Role::where('name', 'pengajar')->firstOrFail();
            return view('admin.users.create', ['role' => $role]);
        }
        
        public function createSiswa()
        {
            $role = Role::where('name', 'siswa')->firstOrFail();
            return view('admin.users.create', ['role' => $role]);
        }
        
    

}
