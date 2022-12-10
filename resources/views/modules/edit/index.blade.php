<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module Inventories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col md:flex-row gap-4 object-center overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}

                <div class="flex-1 w-full card bg-base-100 shadow-md h-56">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ __("Edit Inventory") }}</h2>
                        <p>{{ __("Edit data for item on inventory for stores.") }}</p>
                        <div class="card-actions">
                        <a href="{{ route('module.settings.editoradd.index') }}">
                            <button class="btn btn-primary">
                                {{ __("Go") }}
                            </button>
                        </a>
                        </div>
                    </div>
                </div>

                <div class="flex-1 w-full card bg-base-100 shadow-md h-56">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ __("Integrity") }}</h2>
                        <p>{{ __("Integrity module in store inventories") }}</p>
                        <div class="card-actions">
                        <a href="{{ route('module.inventories.admin.stores.integrity') }}">
                            <button class="btn btn-primary">
                                {{ __("Go") }}
                            </button>
                        </a>
                        </div>
                    </div>
                </div>
                
                <div class="flex-1 w-full card bg-base-100 shadow-md h-56">
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ __("See all") }}</h2>
                        <p>{{ __("Unbalanced product verification module in store inventories") }}</p>
                        <div class="card-actions">
                        <a href="{{ route('module.inventories.admin.stores.seeall') }}">
                            <button class="btn btn-primary">
                                {{ __("Go") }}
                            </button>
                        </a>
                        </div>
                    </div>
                </div>

            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
