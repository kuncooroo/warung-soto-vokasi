@props(['title' => null, 'action' => null, 'actionLabel' => null, 'actionUrl' => null])

<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-1">{{ $title ?? $slot }}</h2>
    </div>
    <div class="flex items-center gap-3">
        @if ($actionUrl && $actionLabel)
            <a href="{{ $actionUrl }}" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ $actionLabel }}
            </a>
        @endif
        {{ $action }}
    </div>
</div>
