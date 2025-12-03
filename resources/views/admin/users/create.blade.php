@extends('layouts.admin')

@section('title', 'Tambah User')
@section('header', 'Tambah User Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm p-8">
    <div class="mb-6 pb-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-800">Informasi Pengguna</h3>
        <p class="text-gray-500 text-sm">Isi data lengkap pengguna di bawah ini.</p>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="Masukkan nama" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="email@contoh.com" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="Minimal 6 karakter" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="0812...">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
            <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil (Opsional)</label>
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                    </div>
                    <input type="file" name="avatar" class="hidden" accept="image/*">
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 shadow-lg shadow-green-200 transition">Simpan User</button>
        </div>
    </form>
</div>
@endsection