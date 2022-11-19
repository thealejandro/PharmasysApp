<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module Market') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 overflow-hidden">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
                <div class="flex gap-4 flex-col md:flex-row object-center h-56">
                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
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

                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
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

                    <div class="flex-1 w-full card bg-base-100 shadow-md">
                        <div class="card-body items-center text-center">
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
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
