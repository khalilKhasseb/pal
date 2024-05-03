<x-filament::button tag="a" target="_blank" href="{{ $file->getFullUrl() }}"
    class="d-block p-3 text-danger bg-primary border border-primary-subtle rounded-3">
    {{ $file->getFullUrl() }}
    <span class="badge text-bg-secondary">{{ __('Show File') }}</span>
</x-filament::button>
