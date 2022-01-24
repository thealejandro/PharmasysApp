<x-app-layout>
    <x-slot name="header">
        <x-module-title title="Sales"></x-module-title>
    </x-slot>

    <x-module>
        <x-modal :id="'choose-items-modal'">
            <x-slot name="button">
                <div class="text-center pt-2">
                    <a href="#choose-items-modal">
                        <button class="btn btn-secondary">
                            Buscar productos
                        </button>
                    </a>
                </div>
            </x-slot>
            <x-slot name="content">
                <livewire:items-finder :query="''"/>
            </x-slot>
        </x-modal>
        <div class="my-2">
            <livewire:sales-table />
        </div>
    </x-module>
</x-app-layout>
