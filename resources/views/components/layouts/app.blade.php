<x-layouts.app.sidebar :title="$title ?? null">
    <x-alerts.modal-alert />
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
