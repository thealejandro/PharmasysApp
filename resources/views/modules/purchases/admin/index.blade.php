<x-app-layout>
    <x-slot name="header">
        {{ __('Module Purchases') }}
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8">
            <div class="flex flex-col object-center h-56 gap-4 md:flex-row">
                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
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

                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
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

                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
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

            <div class="flex flex-col object-center h-56 gap-4 md:flex-row">
                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <h2 class="card-title">{{ __("Credits Phone") }}</h2>
                        <p>{{ __("Purchase phone credits") }}</p>
                        <div class="card-actions">
                            <a href="{{ route('module.purchases.credits.phones.purchase') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <div class="card-actions">
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-full shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <div class="card-actions">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>