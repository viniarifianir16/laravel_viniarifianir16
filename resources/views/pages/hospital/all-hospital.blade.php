<x-layouts.app>
    <div class="flex flex-1 flex-col h-full w-full gap-4 rounded-xl">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h1 class="text-2xl font-bold">Data Rumah Sakit</h1>
            <x-breadcrumbs :breadcrumbs="$breadcrumbs" />
        </div>
        @include ('components.cards.hospital-card')
    </div>
</x-layouts.app>
