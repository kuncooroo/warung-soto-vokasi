@extends('layouts.admin')

@section('title', 'Lihat Pesan')
@section('header', 'Detail Pesan')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-8 w-full border border-gray-100">
        <div class="border-b border-gray-100 pb-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $message->subject }}</h3>
                <span
                    class="px-3 py-1 rounded-full text-xs font-bold {{ $message->is_read ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ $message->is_read ? 'Dibaca' : 'Baru' }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm">
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Nama Pengirim</p>
                    <p class="font-bold text-gray-800 text-lg">{{ $message->name }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Email</p>
                    <p class="font-semibold text-gray-800">{{ $message->email }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">No. Telepon</p>
                    <p class="font-semibold text-gray-800">{{ $message->phone ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <p class="text-gray-500 text-xs uppercase tracking-wide mb-1">Waktu Diterima</p>
                    <p class="font-semibold text-gray-800">{{ $message->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h4 class="font-bold text-gray-700 mb-3 border-l-4 border-green-500 pl-3">Isi Pesan</h4>
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 text-gray-700 whitespace-pre-wrap leading-relaxed">
                {{ $message->message }}
            </div>
        </div>

        <div class="flex gap-4 pt-4 border-t border-gray-100">
            <a href="mailto:{{ $message->email }}"
                class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition shadow-sm hover:shadow-md flex items-center gap-2">
                <span>✉️</span> Balas Email
            </a>

            <a href="{{ route('admin.contact.index') }}"
                class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition">
                Kembali
            </a>
        </div>
    </div>
@endsection
