<x-app-layout>
    <x-slot name="header">
        {{ __('Inventories') }}
    </x-slot>

    <section class="pt-4 lg:max-w-[90%] w-full mx-auto">
            <livewire:inventories.admin.choose-items />
    </section>
</x-app-layout>
