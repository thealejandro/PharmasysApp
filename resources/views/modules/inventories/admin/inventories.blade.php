<x-app-layout>
    <x-slot name="header">
        {{ __('Inventories') }}
    </x-slot>

    <section class="pt-4 lg:max-w-[90%] w-full mx-auto">
        <div
            class="flex flex-col gap-4 px-6 py-4 mx-auto overflow-hidden lg:px-8 md:py-8 md:flex-row">

            <livewire:inventories.admin.choose-items />

            <livewire:inventories.admin.update-items />
        </div>
    </section>
</x-app-layout>
