<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 object-center overflow-hidden">
            <div class="flex flex-col w-full md:flex-row gap-4 overflow-hidden py-5 mx-auto">

                <div class="flex-1 card bg-base-100 shadow-md">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Datos") }}</h2>
                        <div class="form-control">
                            <label class="label gap-4 cursor-pointer">
                                <span class="label-text">¿Agregar producto a la ultima factura de compra?</span>
                                <input type="checkbox" class="toggle toggle-primary"/>
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text-alt">Codigo de barras</span>
                            </label>
                            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text-alt">Descripcion</span>
                            </label>
                            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text-alt">Categoria</span>
                            </label>
                            <select class="select select-bordered">
                                <option disabled selected>Pick one</option>
                                <option>Star Wars</option>
                                <option>Harry Potter</option>
                                <option>Lord of the Rings</option>
                                <option>Planet of the Apes</option>
                                <option>Star Trek</option>
                            </select>
                        </div>

                        <div class="form-controls">
                            <label class="label">
                                <span class="label-text-alt">Marca</span>
                            </label>
                            <select class="select select-bordered">
                                <option disabled selected>Pick one</option>
                                <option>Star Wars</option>
                                <option>Harry Potter</option>
                                <option>Lord of the Rings</option>
                                <option>Planet of the Apes</option>
                                <option>Star Trek</option>
                            </select>
                        </div>

                        {{-- Desactivado visualmente temporalmente --}}

                        {{-- <div class="card-actions w-full">
                            <button class="btn btn-primary w-full">Update</button>
                        </div> --}}
                    </div>
                </div>

                <div class="flex-1 card bg-base-100 shadow-md">
                    <div class="card-body justify-between">
                        <h2 class="card-title">{{ __("Ingreso") }}</h2>
                        <div class="form-control h-full gap-2">
                            <label class="input-group">
                                <span>{{ __("Cantidad de compra") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                            <label class="input-group">
                                <span>{{ __("Precio unidad de compra") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                            <label class="input-group">
                                <span>{{ __("Precio unidad de venta") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full md:flex-row gap-4 overflow-hidden py-5 mx-auto">
                <div class="flex-1 card bg-base-100 shadow-md">
                    <div class="card-body justify-between">
                        <h2 class="card-title">{{ __("Presentations") }}</h2>
                        <div class="flex flex-col gap-1 w-full">
                            <label class="input-group w-full">
                                <span>{{ __("Name") }}</span>
                                <input type="text" placeholder="Blister" class="input input-bordered" />
                            </label>
                            <label class="input-group w-full">
                                <span>{{ __("Price") }}</span>
                                <input type="text" placeholder="0.00" class="input input-bordered" />
                            </label>
                        </div>
                        <div class="divider"></div>
                        <div class="flex flex-col gap-1 w-full">
                            <label class="input-group w-full">
                                <span>{{ __("Name") }}</span>
                                <input type="text" placeholder="Caja" class="input input-bordered" />
                            </label>
                            <label class="input-group w-full">
                                <span>{{ __("Price") }}</span>
                                <input type="text" placeholder="0.00" class="input input-bordered" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex-1 card bg-base-100 shadow-md">
                    <div class="card-body justify-between">
                        <h2 class="card-title">{{ __("Others") }}</h2>
                        <div class="flex flex-col gap-1 w-full h-full">
                            <label class="input-group w-full">
                                <span>{{ __("Expiry") }}</span>
                                <input type="text" placeholder="mm/aaaa" class="input input-bordered" />
                            </label>
                            <label class="input-group w-full">
                                <span>{{ __("Stock") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card-actions flex flex-col w-full"> --}}
                <button class="btn btn-success w-full">{{ __("Save") }}</button>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
