@extends('layouts.admin')

@section('title', 'Pesan')
@section('header', 'Pesan dari Pengunjung')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="admin-table w-full">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Subjek</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold tracking-wide">Status</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $message)
                    <tr class="transition duration-150 hover:bg-green-50 {{ !$message->is_read ? 'bg-yellow-50/50' : '' }}">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $message->name }}</td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $message->email }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ Str::limit($message->subject, 30) }}</td>
                        <td class="px-6 py-4">
                            <x-status-badge :value="$message->is_read ? 'read' : 'unread'" :variant="$message->is_read ? 'success' : 'warning'" />
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.contact.show', $message) }}"
                                    class="admin-action-view">
                                    Lihat
                                </a>

                                <x-confirm-delete id="delete-message-{{ $message->id }}" action="{{ route('admin.contact.destroy', $message) }}" title="Hapus Pesan" message="Hapus pesan ini?" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <x-empty-state title="Tidak ada pesan" message="Tidak ada pesan masuk." icon="contact" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
