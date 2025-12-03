@extends('layouts.admin')

@section('title', 'Admin')
@section('header', 'Kelola Admin')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-xl font-bold text-gray-800">Daftar Admin</h3>

        <a href="{{ route('admin.admins.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-sm flex items-center gap-2">
            <span>+</span> Tambah Admin
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Role</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">No. Telp</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($admins as $admin)
                    <tr class="hover:bg-green-50 transition duration-150">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $admin->name }}</td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $admin->email }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold {{ $admin->role === 'superadmin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($admin->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $admin->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.admins.edit', $admin) }}"
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md text-xs font-bold hover:bg-yellow-200 transition">
                                    Edit
                                </a>

                                @if ($admin->id !== session()->get('admin_id'))
                                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline"
                                        onclick="return confirm('Yakin hapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold hover:bg-red-200 transition">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-2xl mb-2">🛡️</span>
                                <p>Belum ada data admin.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
