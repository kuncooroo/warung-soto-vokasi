@extends('layouts.admin')

@section('title', 'Kelola User')
@section('header', 'Daftar User')

@section('content')

<x-admin-page-header title="Kelola User" actionUrl="{{ route('admin.users.create') }}" actionLabel="Tambah User" />

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="admin-table w-full">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">User</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Kontak</th>
                <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Alamat</th>
                <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

            @forelse ($users as $user)
            <tr class="hover:bg-green-50 transition duration-150">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" 
                                 class="w-10 h-10 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-lg">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif

                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-xs text-gray-200">{{ $user->email }}</p>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4 text-gray-700 text-sm">
                    {{ $user->phone ?? '-' }}
                </td>

                <td class="px-6 py-4 text-gray-700 text-sm truncate max-w-xs">
                    {{ $user->address ?? '-' }}
                </td>

                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center items-center space-x-2">

                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                           class="admin-action-edit">
                            Edit
                        </a>

                        <x-confirm-delete id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" title="Hapus User" message="Apakah Anda yakin ingin menghapus user ini?" />

                    </div>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                    <x-empty-state title="Belum ada data user" message="Belum ada data user." icon="user" />
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $users->links() }}
</div>

@endsection
