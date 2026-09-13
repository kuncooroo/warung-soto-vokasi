@props(['title' => null])

<div class="admin-card">
    @if ($title)
        <h3 class="text-lg font-bold text-gray-900 mb-6">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
