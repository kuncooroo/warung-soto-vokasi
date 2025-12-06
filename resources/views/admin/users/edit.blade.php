@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">

        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}"
                    class="w-16 h-16 rounded-full object-cover shadow-sm border border-gray-200">
            @else
                <div
                    class="w-16 h-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-2xl">
                    {{ substr($user->name, 0, 1) }}
                </div>
            @endif

            <div>
                <h3 class="text-lg font-bold text-gray-800">{{ $user->name }}</h3>
                <p class="text-gray-500 text-sm">Perbarui informasi pengguna.</p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none 
                              focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none 
                              focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                        Password Baru <span class="text-gray-400 font-normal normal-case">(Kosongkan jika tidak
                            diganti)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none 
                              focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition"
                        placeholder="Masukkan password baru">
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                        Nomor Telepon
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none 
                              focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                    Alamat Lengkap
                </label>
                <textarea name="address" rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none 
                             focus:ring-2 focus:ring-green-500/50 focus:border-green-500 transition">{{ old('address', $user->address) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">
                    Ganti Foto Profil
                </label>

                <input type="file" name="avatar" accept="image/*"
                    class="block w-full text-sm text-gray-700
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-semibold
                          file:bg-green-50 file:text-green-700
                          hover:file:bg-green-100
                          transition cursor-pointer">
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold 
                           hover:bg-green-700 transition shadow-sm hover:shadow-md">
                    Update User
                </button>

                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 
                      rounded-lg font-bold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>

        </form>
    </div>
@endsection
