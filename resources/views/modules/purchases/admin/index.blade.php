<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module Purchases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                <div class="flex gap-4 flex-col md:flex-row object-center h-56">
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title">{{ __("Add Purchase") }}</h2>
                            <p>{{ __("Module to register new purchase invoices") }}</p>
                            <div class="card-actions">
                            <a href="{{ route('module.purchases.new.purchase') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title">{{ __("Add Product") }}</h2>
                            <p>{{ __("General store inventory module") }}</p>
                            <div class="card-actions">
                            <a href="{{ route('module.items.new.item') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
                            <h2 class="card-title">{{ __("Shopping Record") }}</h2>
                            <p>{{ __("Integrity module in store inventories") }}</p>
                            <div class="card-actions">
                            <a href="{{ route('module.purchases.records.purchases') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex gap-4 flex-col md:flex-row object-center h-56">
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
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
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
                            <div class="card-actions">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
                            <div class="card-actions">
                            </div>
                        </div>
                    </div>
                </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
