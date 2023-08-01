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
                        <h2 class="card-title">{{ __("Edit Items") }}</h2>
                        <p>{{ __("") }}</p>
                        <div class="card-actions">
                            <a href="{{ route('module.settings.editoradd.items.index') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex-1 w-full h-56 shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <h2 class="card-title">{{ __("Edit Phones") }}</h2>
                        <p>{{ __("") }}</p>
                        <div class="card-actions">
                            <a href="{{ route('module.settings.editoradd.telephonies.index') }}">
                                <button class="btn btn-primary">
                                    {{ __("Go") }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex-1 w-full h-56 shadow-md card bg-base-100">
                    <div class="items-center text-center card-body">
                        <h2 class="card-title">{{ __("Edit Users") }}</h2>
                        <p>{{ __("") }}</p>
                        <div class="card-actions">
                            <a href="{{ route('module.settings.editoradd.users.index') }}">
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