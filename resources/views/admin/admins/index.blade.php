@extends('layouts.admin')

@section('title', 'Admin')
@section('header', 'Kelola Admin')

@section('content')
    <x-admin-page-header title="Daftar Admin" actionUrl="{{ route('admin.admins.create') }}" actionLabel="Tambah Admin" />

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="admin-table w-full">
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
                            <x-status-badge :value="$admin->role" :variant="$admin->role" />
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $admin->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.admins.edit', $admin) }}"
                                    class="admin-action-edit">
                                    Edit
                                </a>

                                @if ($admin->id !== session()->get('admin_id'))
                                    <x-confirm-delete id="delete-admin-{{ $admin->id }}" action="{{ route('admin.admins.destroy', $admin) }}" title="Hapus Admin" message="Yakin hapus admin ini?" />
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <x-empty-state title="Belum ada data admin" message="Belum ada data admin." icon="admin" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
