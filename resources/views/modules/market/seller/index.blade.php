<x-app-layout>
    <x-slot name="header">
        {{ __('Market') }}
    </x-slot>

    <div class="pt-4 lg:max-w-[90%] w-full mx-auto">

        {{-- <livewire:sell-items wire:key="sell-items-component" /> --}}

        @livewire('sell-items')

        @livewire('choose-items-modal')
    </div>
</x-app-layout>
