<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
        $this->checkSuperAdmin();
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->checkSuperAdmin();
        return view('admin.admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        $this->checkSuperAdmin();

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit(Admin $admin)
    {
        $this->checkSuperAdmin();
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $this->checkSuperAdmin();

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy(Admin $admin)
    {
        $this->checkSuperAdmin();

        if ($admin->id === session()->get('admin_id')) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri']);
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus');
    }
}