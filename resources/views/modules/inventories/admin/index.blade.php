<x-app-layout>
    <x-slot name="header">
        {{ __('Module Inventories') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:flex-row">
            {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}
                <div class="flex-1 w-full h-56 shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <h2 class="card-title">{{ __("Inventories") }}</h2>
                        <p>{{ __("Individual store inventory module") }}</p>
                        <div class="card-actions">
                            <a href="{{ route('module.inventories.admin.stores.inventories') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <div class="flex-1 w-full shadow-md card bg-base-100 md:shadow-xl"> --}}
                    {{-- <div class="items-center text-center card-body"> --}}
                        {{-- <h2 class="card-title">{{ __("Overall Inventory") }}</h2> --}}
                        {{-- <p>{{ __("General store inventory module") }}</p> --}}
                        {{-- <div class="card-actions"> --}}
                            {{-- <a href="{{ route('module.inventories.admin.stores.overall') }}"> --}}
                                {{-- <button class="btn btn-primary"> --}}
                                    {{-- {{ __("Go") }} --}}
                                    {{-- </button> --}}
                                {{-- </a> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                <div class="flex-1 w-full h-56 shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
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
                <div class="flex-1 w-full h-56 shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
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
                {{--
            </div> --}}
        </div>
    </div>
</x-app-layout>