<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8">
            <div class="flex flex-col w-full gap-4 py-5 mx-auto overflow-hidden md:flex-row">

                <div class="flex-1 shadow-md card bg-base-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ __("Datos") }}</h2>
                        <div class="form-control">
                            <label class="gap-4 cursor-pointer label">
                                <span class="label-text">¿Agregar producto a la ultima factura de compra?</span>
                                <input type="checkbox" class="toggle toggle-primary"/>
                            </label>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text-alt">Codigo de barras</span>
                            </label>
                            <input type="text" placeholder="Type here" class="w-full max-w-xs input input-bordered" />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text-alt">Descripcion</span>
                            </label>
                            <input type="text" placeholder="Type here" class="w-full max-w-xs input input-bordered" />
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

                        {{-- Se utiliza solo para cuando el toogle esta desmarcado, al estar marcado aparecen las siguientes tarjetas y desactiva este boton --}}

                        <div class="w-full card-actions">
                            <button class="w-full btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>

                <div class="flex-1 shadow-md card bg-base-100">
                    <div class="justify-between card-body">
                        <h2 class="card-title">{{ __("Ingreso") }}</h2>
                        <div class="h-full gap-2 form-control">
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

            <div class="flex flex-col w-full gap-4 py-5 mx-auto overflow-hidden md:flex-row">
                <div class="flex-1 shadow-md card bg-base-100">
                    <div class="justify-between card-body">
                        <h2 class="card-title">{{ __("Presentations") }}</h2>
                        <div class="flex flex-col w-full gap-1">
                            <label class="w-full input-group">
                                <span>{{ __("Name") }}</span>
                                <input type="text" placeholder="Blister" class="input input-bordered" />
                            </label>
                            <label class="w-full input-group">
                                <span>{{ __("Price") }}</span>
                                <input type="text" placeholder="0.00" class="input input-bordered" />
                            </label>
                        </div>
                        <div class="divider"></div>
                        <div class="flex flex-col w-full gap-1">
                            <label class="w-full input-group">
                                <span>{{ __("Name") }}</span>
                                <input type="text" placeholder="Caja" class="input input-bordered" />
                            </label>
                            <label class="w-full input-group">
                                <span>{{ __("Price") }}</span>
                                <input type="text" placeholder="0.00" class="input input-bordered" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex-1 shadow-md card bg-base-100">
                    <div class="justify-between card-body">
                        <h2 class="card-title">{{ __("Others") }}</h2>
                        <div class="flex flex-col w-full h-full gap-1">
                            <label class="w-full input-group">
                                <span>{{ __("Expiry") }}</span>
                                <input type="text" placeholder="mm/aaaa" class="input input-bordered" />
                            </label>
                            <label class="w-full input-group">
                                <span>{{ __("Stock") }}</span>
                                <input type="text" placeholder="0" class="input input-bordered" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button class="w-full btn btn-success">{{ __("Save") }}</button>
        </div>
    </div>
</x-app-layout>
