@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('content')
    <x-admin-page-header title="Edit Admin" />

    <x-admin-form-card>
        <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-input"
                        value="{{ $admin->name }}" required>
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input"
                        value="{{ $admin->email }}" required>
                </div>
            </div>

            <div>
                <label class="form-label">No. Telepon</label>
                <input type="text" name="phone" class="form-input"
                    value="{{ $admin->phone }}">
            </div>

            <div>
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ $admin->role === 'superadmin' ? 'selected' : '' }}>SuperAdmin</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    Update Admin
                </button>
                <a href="{{ route('admin.admins.index') }}" class="btn-secondary">
                    Batal
                </a>
            </div>
        </form>
    </x-admin-form-card>
@endsection
