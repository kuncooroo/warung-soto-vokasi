@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm p-8">
    <div class="mb-6 pb-4 border-b border-gray-100 flex items-center gap-4">
        @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-16 h-16 rounded-full object-cover shadow-sm">
        @else
            <div class="w-16 h-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-2xl">
                {{ substr($user->name, 0, 1) }}
            </div>
        @endif
        <div>
            <h3 class="text-lg font-bold text-gray-800">Edit : {{ $user->name }}</h3>
            <p class="text-gray-500 text-sm">Perbarui informasi pengguna.</p>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru <span class="text-gray-400 font-normal text-xs">(Kosongkan jika tidak diganti)</span></label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="Masukkan password baru">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
            <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old('address', $user->address) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto Profil</label>
            <input type="file" name="avatar" class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-xl file:border-0
                file:text-sm file:font-semibold
                file:bg-green-50 file:text-green-700
                hover:file:bg-green-100
                transition cursor-pointer
            " accept="image/*">
        </div>

        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 shadow-lg shadow-green-200 transition">Update User</button>
        </div>
    </form>
</div>
@endsection