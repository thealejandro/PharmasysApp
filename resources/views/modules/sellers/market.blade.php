<x-app-layout>
    <x-slot name="header">
        <x-module-title title="Sales"></x-module-title>
    </x-slot>

    <x-module>
        <x-modal :id="'choose-items-modal'">
            <x-slot name="button">
                <a href="#choose-items-modal">
                    <div class="form-control">
                        <input type="text" class="input input-bordered" placeholder="Buscar productos" autofocus>
                    </div>
                </a>
            </x-slot>
            <x-slot name="content">
                <livewire:items-finder :query="''">
            </x-slot>
        </x-modal>
        <div class="my-2">
            <livewire:sales-table />
        </div>
    </x-module>
</x-app-layout>
