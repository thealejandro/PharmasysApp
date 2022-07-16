<x-app-layout>
    <x-slot name="header">
        <x-module-title title="Sales"></x-module-title>
    </x-slot>

    <x-module>
        <div class="text-center pt-2">
            <a>
                <button class="btn btn-secondary">
                    Facturar
                </button>
            </a>
        </div>
        <livewire:record-sales-of-seller/>
    </x-module>
</x-app-layout>
