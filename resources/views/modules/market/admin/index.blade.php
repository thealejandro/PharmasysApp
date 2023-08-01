<x-app-layout>
    <x-slot name="header">
        {{ __('Module Market') }}
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8">
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}
                <div class="flex flex-col object-center h-56 gap-4 md:flex-row">
                    <div class="flex-1 w-full shadow-md card bg-base-100">
                        <div class="items-center text-center card-body">
                            <h2 class="card-title">{{ __("Invoicing") }}</h2>
                            <p>{{ __("Module generate invoices") }}</p>
                            <div class="card-actions">
                                <a href="{{ route('module.market.admin.warehouse.invoicing') }}">
                                    <button class="btn btn-primary">
                                        {{ __("Go") }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 w-full shadow-md card bg-base-100">
                        <div class="items-center text-center card-body">
                            <h2 class="card-title">{{ __("Warehouse Shipments") }}</h2>
                            <p>{{ __("Shipments warehouse module") }}</p>
                            <div class="card-actions">
                                <a href="{{ route('module.market.admin.warehouse.shipments') }}">
                                    <button class="btn btn-primary">
                                        {{ __("Go") }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 w-full shadow-md card bg-base-100">
                        <div class="items-center text-center card-body">
                            <h2 class="card-title">{{ __("All Records") }}</h2>
                            <p>{{ __("Records all") }}</p>
                            <div class="card-actions">
                                <a href="{{ route('module.market.admin.warehouse.records') }}">
                                    <button class="btn btn-primary">
                                        {{ __("Go") }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
            </div> --}}
        </div>
    </div>
</x-app-layout>