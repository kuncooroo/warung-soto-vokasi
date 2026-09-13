@props(['value', 'variant' => 'default'])

@php
    $variantClasses = match($variant) {
        'success', 'paid', 'approved', 'completed', 'halal', 'active' => 'bg-green-100 text-green-700',
        'warning', 'pending', 'unread' => 'bg-yellow-100 text-yellow-700',
        'danger', 'error', 'cancelled', 'rejected', 'failed', 'not-halal' => 'bg-red-100 text-red-700',
        'info', 'processing', 'admin' => 'bg-blue-100 text-blue-700',
        'superadmin' => 'bg-purple-100 text-purple-700',
        'inactive' => 'bg-gray-100 text-gray-500',
        default => 'bg-gray-100 text-gray-700',
    };

    $displayValue = match($value) {
        'paid' => 'Lunas',
        'pending' => 'Pending',
        'processing' => 'Diproses',
        'completed' => 'Selesai',
        'failed' => 'Gagal',
        'cancelled' => 'Dibatalkan',
        'shipped' => 'Dikirim',
        'approved' => 'Disetujui',
        'rejected' => 'Ditolak',
        'read' => 'Dibaca',
        'unread' => 'Belum Dibaca',
        'halal' => 'Halal',
        'not-halal' => 'Tidak Halal',
        'admin' => 'Admin',
        'superadmin' => 'Superadmin',
        'active' => 'Aktif',
        'inactive' => 'Nonaktif',
        default => $value,
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $variantClasses }}">
    {{ $displayValue }}
</span>
