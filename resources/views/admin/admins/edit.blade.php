@extends('layouts.admin')

@section('title', 'Edit Admin')
@section('header', 'Edit Admin')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
        <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Nama</label>
                    <input type="text" name="name"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        value="{{ $admin->name }}" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Email</label>
                    <input type="email" name="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        value="{{ $admin->email }}" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">No. Telepon</label>
                <input type="text" name="phone"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                    value="{{ $admin->phone }}">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Role</label>
                <select name="role"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition bg-white"
                    required>
                    <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ $admin->role === 'superadmin' ? 'selected' : '' }}>SuperAdmin</option>
                </select>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md">
                    Update Admin
                </button>
                <a href="{{ route('admin.admins.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
