<x-app-layout>
    <x-slot name="header">
        {{ __('Market') }}
    </x-slot>

    <div class="pt-4 lg:max-w-[90%] w-full mx-auto">
        @livewire('choose-items-modal')

        <livewire:sell-items wire:key="sell-items-component" />

        {{-- @livewire('sell-items') --}}

    </div>
</x-app-layout>