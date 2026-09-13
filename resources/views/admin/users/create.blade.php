@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
    <x-admin-page-header title="Tambah User Baru" />

    <x-admin-form-card title="Informasi Pengguna">
        <p class="text-gray-500 text-sm mb-6">Isi data lengkap pengguna di bawah ini.</p>

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input"
                        placeholder="Masukkan nama" required>
                </div>

                <div>
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input"
                        placeholder="email@contoh.com" required>
                </div>

                <div>
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input"
                        placeholder="Minimal 6 karakter" required>
                </div>

                <div>
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-input"
                        placeholder="0812...">
                </div>
            </div>

            <div>
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="address" rows="3" class="form-textarea"
                    placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
            </div>

            <div>
                <label class="form-label">Foto Profil (Opsional)</label>
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
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan User</button>
            </div>
        </form>
    </x-admin-form-card>
@endsection