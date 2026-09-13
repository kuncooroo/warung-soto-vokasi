@extends('layouts.admin')

@section('title', 'Tambah Admin')

@section('content')
    <x-admin-page-header title="Tambah Admin Baru" />

    <x-admin-form-card>
        <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-input" required>
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">No. Telepon</label>
                <input type="text" name="phone" class="form-input">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" required>
                </div>

                <div>
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="superadmin">SuperAdmin</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Tambah Admin
                </button>
                <a href="{{ route('admin.admins.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
