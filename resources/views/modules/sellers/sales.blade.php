<x-app-layout>
    <x-slot name="header">
        <x-module-title title="Sales"></x-module-title>
    </x-slot>

    <x-module>
        <livewire:items-finder :query="''" />
    </x-module>
</x-app-layout>
