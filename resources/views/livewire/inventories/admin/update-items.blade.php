<div class="flex flex-col gap-4">
    <div class="shadow-lg stats">
        <div class="stat place-items-center">
            <div class="stat-title">Items</div>
            <div class="stat-value">1,235</div>
            <div class="stat-actions">
                <button class="btn btn-sm btn-secondary">Export inventory</button>
            </div>
        </div>
    </div>

    <div class="shadow-lg card bg-base-100">
        <div class="gap-3 card-body">
            <h2 class="card-title">{{ __("Location") }}</h2>
                <x-w-input placeholder="0" class="pl-[4.6rem]">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-3">
                            <span class="rounded-l-md text-primary-400">{{ __("Estante") }}</span>
                        </div>
                    </x-slot>
                </x-w-input>
                <x-w-input placeholder="0" class="pl-14">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-3">
                            <span class="rounded-l-md text-primary-400">{{ __("Nivel") }}</span>
                        </div>
                    </x-slot>
                </x-w-input>
                <x-w-input placeholder="0" class="pl-14">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-3">
                            <span class="rounded-l-md text-primary-400">{{ __("Caja") }}</span>
                        </div>
                    </x-slot>
                </x-w-input>
            @if(!$lockButton)
                <div class="text-center">
                    <x-w-button icon="save" md rounded positive label="Update" wire:click='updateLocation' />
                </div>
            @endif
        </div>
    </div>

    <div class="shadow-lg card bg-base-100">
        <div class="gap-3 card-body">
            <h2 class="card-title">{{ __("Prices") }}</h2>
            <x-w-input placeholder="0.00" class="pl-[5.6rem]" value="{{ $pricePurchase }}">
                <x-slot name="prepend">
                    <div class="absolute inset-y-0 left-0 flex items-center p-3">
                        <span class="rounded-l-md text-primary-400">{{ __("Purchase") }}</span>
                    </div>
                </x-slot>
            </x-w-input>
                <x-w-input placeholder="0.00" class="pl-14" value="{{ $priceSale }}">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-3">
                            <span class="rounded-l-md text-primary-400">{{ __("Sale") }}</span>
                        </div>
                    </x-slot>
                </x-w-input>
            @if(!$lockButton)
            <div class="text-center">
                <x-w-button icon="save" md rounded positive label="Update" wire:click='updatePrices' />
            </div>
            @endif
        </div>
    </div>

    <div class="shadow-lg card bg-base-100">
        <div class="gap-3 card-body">
            <h2 class="card-title">{{ __('Presentations') }}</h2>
            @if(count($presentations) > 0)
                @foreach ($presentations as $presentation)
                    <div class="flex justify-between gap-2">
                        <x-w-input placeholder="{{ __('Presentación') }}" class="pl-16" value="{{ $presentation['presentacion'] }}">
                            <x-slot name="prepend">
                                <div class="absolute inset-y-0 left-0 flex items-center p-3">
                                    <span class="rounded-l-md text-primary-400">{{ __("Name") }}</span>
                                </div>
                            </x-slot>
                        </x-w-input>
                        <x-w-input placeholder="0.00" class="pl-14" value="{{ $presentation['precio'] }}">
                            <x-slot name="prepend">
                                <div class="absolute inset-y-0 left-0 flex items-center p-3">
                                    <span class="rounded-l-md text-primary-400">{{ __("Price") }}</span>
                                </div>
                            </x-slot>
                        </x-w-input>
                        <x-w-button icon="save" md rounded positive label="Update" wire:click="updatePresentation({{ $presentation['idpresentacion'] }})" />
                    </div>

                    @if(!$loop->last)
                        <div class="m-0 divider"></div>
                    @endif
                @endforeach
            @else
                <div class="flex justify-between gap-2">
                    <x-w-input placeholder="{{ __('Presentación') }}" class="pl-16">
                        <x-slot name="prepend">
                            <div class="absolute inset-y-0 left-0 flex items-center p-3">
                                <span class="rounded-l-md text-primary-400">{{ __("Name") }}</span>
                            </div>
                        </x-slot>
                    </x-w-input>
                    <x-w-input placeholder="0.00" class="pl-14">
                        <x-slot name="prepend">
                            <div class="absolute inset-y-0 left-0 flex items-center p-3">
                                <span class="rounded-l-md text-primary-400">{{ __("Price") }}</span>
                            </div>
                        </x-slot>
                    </x-w-input>
                </div>
            @endif
        </div>
    </div>

    <div class="shadow-lg card bg-base-100">
        <div class="gap-3 card-body">
            <h2 class="card-title">{{ __("Others") }}</h2>
                <x-w-datetime-picker
                    label="{{ __('Expiration Date') }}"
                    placeholder="mm/aaaa"
                    parse-format="MM-YYYY"
                    wire:model.defer="customFormat"
                    without-timezone
                    display-format="MM-YYYY"
                    without-time
                    value="{{ $expirationDate }}" class="w-full"
                />

                @if(!$lockButton)
                    <x-w-button icon="save" md rounded positive label="Update" wire:click='updateExpirationDate' />
                @endif

                <x-w-input placeholder="0" class="pl-14" value="{{ $stock }}">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center p-3">
                            <span class="rounded-l-md text-primary-400">{{ __("Stock") }}</span>
                        </div>
                    </x-slot>
                </x-w-input>
                @if(!$lockButton)
                    <div class="text-center">
                        <x-w-button icon="save" md rounded positive label="Update" wire:click='updateStock' />
                    <div class="text-center">
                @endif
        </div>
    </div>
</div>
