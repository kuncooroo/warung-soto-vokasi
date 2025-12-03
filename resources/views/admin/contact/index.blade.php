@extends('layouts.admin')

@section('title', 'Pesan')
@section('header', 'Pesan dari Pengunjung')

@section('content')
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full">
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
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold {{ $message->is_read ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $message->is_read ? 'Dibaca' : 'Baru' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.contact.show', $message) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md text-xs font-bold hover:bg-blue-200 transition">
                                    Lihat
                                </a>

                                <form action="{{ route('admin.contact.destroy', $message) }}" method="POST" class="inline"
                                    onclick="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-xs font-bold hover:bg-red-200 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center justify-center">
                                <p>Tidak ada pesan masuk.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
