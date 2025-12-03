<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function checkLogin()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
    }

    private function checkSuperAdmin()
    {
        $adminId = session()->get('admin_id');
        $admin = Admin::find($adminId);
        if (!$admin || $admin->role !== 'superadmin') {
            abort(403, 'Hanya superadmin yang bisa mengakses halaman ini');
        }
    }

    public function index()
    {
        $this->checkLogin();
        $this->checkSuperAdmin();
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->checkLogin();
        $this->checkSuperAdmin();
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $this->checkLogin();
        $this->checkSuperAdmin();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,superadmin'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit(Admin $admin)
    {
        $this->checkLogin();
        $this->checkSuperAdmin();
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $this->checkLogin();
        $this->checkSuperAdmin();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,superadmin'
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy(Admin $admin)
    {
        $this->checkLogin();
        $this->checkSuperAdmin();

        if ($admin->id === session()->get('admin_id')) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri']);
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus');
    }
}