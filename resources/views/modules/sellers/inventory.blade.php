<x-app-layout>
    <x-slot name="header">
        <x-module-title :title="'Inventory'"></x-module-title>
    </x-slot>
    <x-module>
        <div class="my-2">
            <livewire:inventory-table :query="''" />
        </div>
    </x-module>
</x-app-layout>
