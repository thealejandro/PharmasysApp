<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Market') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('choose-items-modal')

        <livewire:sell-items wire:key="sell-items-component" />

        {{-- @livewire('sell-items') --}}

    </div>
</x-app-layout>
