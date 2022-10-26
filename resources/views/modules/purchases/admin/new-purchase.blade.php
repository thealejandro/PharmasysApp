<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Purchase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 md:gap-6 object-center overflow-hidden">
            <div class="flex flex-col md:flex-row gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}
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
                    <div class="flex-1 flex justify-center">
                        <div class="form-control">
                            <label class="label gap-2 cursor-pointer">
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
                        <input type="text" placeholder="Numero de factura" class="input input-bordered w-full max-w-xs" />
                    </div>

                    {{-- fecha --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Fecha de factura</span>
                        </label>
                        <input type="date" class="input input-bordered w-full max-w-xs" />
                    </div>
                {{-- </div> --}}
            </div>
            <div class="flex flex-col md:flex-row gap-4 md:gap-5 w-full">
                <div class="flex-1 flex flex-col bg-white p-5 shadow-md sm:rounded-lg overflow-hidden">
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

                <div class="flex-1 flex flex-col gap-4">
                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Location") }}</h2>
                            <div class="form-control gap-2">
                                <label class="input-group">
                                    <span>{{ __("Estante") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered" />
                                </label>
                                <label class="input-group">
                                    <span>{{ __("Nivel") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered" />
                                </label>
                                <label class="input-group">
                                    <span>{{ __("Caja") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered" />
                                </label>
                            </div>
                            <div class="card-actions w-full">
                                <button class="btn btn-primary w-full">Update</button>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-base-100 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title">{{ __("Prices") }}</h2>
                            <div class="form-control">
                                <label class="input-group">
                                    <span>{{ __("Purchase") }}</span>
                                    <input type="text" placeholder="0.00" class="input input-bordered" />
                                </label>
                                <div class="divider"></div>
                                <div class="form-control">
                                    <label class="input-group">
                                        <span>{{ __("Sale") }}</span>
                                        <input type="text" placeholder="0.00" class="input input-bordered" />
                                    </label>
                                </div>
                            </div>
                            <div class="card-actions w-full">
                                <button class="btn btn-primary w-full">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
