@extends('layouts.admin')

@section('title', 'Lihat Pesan')
@section('header', 'Detail Pesan')

@section('content')
    <x-admin-page-header title="Detail Pesan" />

    <x-admin-form-card>
        <div class="border-b border-gray-100 pb-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $message->subject }}</h3>
                <x-status-badge :value="$message->is_read ? 'read' : 'unread'" :variant="$message->is_read ? 'success' : 'warning'" />
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
            <a href="mailto:{{ $message->email }}" class="btn-primary">
                <span>✉️</span> Balas Email
            </a>

            <a href="{{ route('admin.contact.index') }}" class="btn-secondary">
                Kembali
            </a>
        </div>
    </x-admin-form-card>
@endsection
