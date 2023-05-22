<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Register New Purchase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-6">
            <div class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden bg-white shadow-md md:flex-row md:gap-6 sm:rounded-lg">

                    {{-- proveedor --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Proveedor</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione un proveedor</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    {{-- switch factura contable --}}
                    <div class="flex justify-center flex-1">
                        <div class="form-control">
                            <label class="gap-2 cursor-pointer label">
                                <span class="label-text">Factura contable</span>
                                <input type="checkbox" class="toggle" checked />
                            </label>
                        </div>
                    </div>

                    {{-- numero --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Numero de factura</span>
                        </label>
                        <input type="text" placeholder="Numero de factura" class="w-full max-w-xs input input-bordered" />
                    </div>

                    {{-- fecha --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Fecha de factura</span>
                        </label>
                        <input type="date" class="w-full max-w-xs input input-bordered" />
                    </div>
            </div>
            <div class="flex flex-col w-full gap-4 md:flex-row md:gap-5">
                <div class="flex flex-col flex-1 p-5 overflow-hidden bg-white shadow-md sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr class="hover">
                                    <th>1</th>
                                    <td>Quality Control Specialist</td>
                                </tr>
                                <!-- row 2 -->
                                <tr class="hover">
                                    <th>2</th>
                                    <td>Desktop Support Technician</td>
                                </tr>
                                <!-- row 3 -->
                                <tr class="hover">
                                    <th>3</th>
                                    <td>Tax Accountant</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex flex-col flex-1 gap-4">
                    <div class="shadow-lg card bg-base-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Ingreso") }}</h2>
                            <div class="gap-2 form-control">
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

                    <div class="shadow-lg card bg-base-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Presentations") }}</h2>
                            <div class="flex flex-col w-full card-actions">
                                <div class="flex flex-col w-full gap-1">
                                    <label class="w-full input-group">
                                        <span>{{ __("Name") }}</span>
                                        <input type="text" placeholder="Blister" class="input input-bordered" />
                                    </label>
                                    <label class="w-full input-group">
                                        <span>{{ __("Quantity") }}</span>
                                        <input type="text" placeholder="0" class="input input-bordered" />
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
                                        <span>{{ __("Quantity") }}</span>
                                        <input type="text" placeholder="0" class="input input-bordered" />
                                    </label>
                                    <label class="w-full input-group">
                                        <span>{{ __("Price") }}</span>
                                        <input type="text" placeholder="0.00" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-lg card bg-base-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Others") }}</h2>
                            <div class="flex flex-col w-full card-actions">
                                <div class="flex flex-col w-full gap-1">
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
        </div>
    </div>
</x-app-layout>
