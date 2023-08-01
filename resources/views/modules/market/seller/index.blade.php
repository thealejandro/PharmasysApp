<x-app-layout>
    <x-slot name="header">
        {{ __('Market') }}
    </x-slot>

    <div class="py-6">
        @livewire('choose-items-modal')

        <livewire:sell-items wire:key="sell-items-component" />

        {{-- @livewire('sell-items') --}}

    </div>
</x-app-layout>
