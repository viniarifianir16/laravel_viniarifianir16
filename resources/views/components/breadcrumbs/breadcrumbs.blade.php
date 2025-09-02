@props(['breadcrumbs' => null])

@php
    $items = $breadcrumbs;

    if ($breadcrumbs) {
        $items = $breadcrumbs;
    } else {
        $segments = request()->segments();
        $url = '';
        $items = [];

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $items[] = [
                'label' => ucfirst(str_replace('-', ' ', $segment)),
                'url' => $url,
            ];
        }
    }
@endphp

<flux:breadcrumbs>
    <flux:breadcrumbs.item href="{{ url('dashboard') }}" separator="slash">Dashboard</flux:breadcrumbs.item>

    @foreach ($items as $key => $item)
        @if ($key === count($items) - 1)
            <flux:breadcrumbs.item separator="slash">{{ $item['label'] }}</flux:breadcrumbs.item>
        @else
            <flux:breadcrumbs.item href="{{ url($item['url']) }}" separator="slash">
                {{ $item['label'] }}
            </flux:breadcrumbs.item>
        @endif
    @endforeach
</flux:breadcrumbs>
