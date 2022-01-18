<x-app-layout>
    <x-slot name="header">
        <x-module-title title="Sales"></x-module-title>
    </x-slot>

    <x-module>
        <livewire:items-finder :query="''" />
        <livewire:sales-table />
    </x-module>
</x-app-layout>
