<x-app-layout>
    <x-slot name="header">
        {{ __('Credits Phone') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-6">
            <div
                class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
                <h1 class="card-title">Compra de Saldo</h1>

                <div class="flex flex-col items-center w-full gap-4 md:flex-row md:gap-6">
                    {{-- Sucursal --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Sucursal</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione una sucursal</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    {{-- telefonia --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Telefonia</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione una telefonia</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    {{-- telefono --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Telefono</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione un telefono</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    {{-- fecha de compra --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Fecha de compra</span>
                        </label>
                        <input type="date" class="w-full max-w-xs input input-bordered" />
                    </div>
                </div>

                <div class="flex flex-col items-center w-full gap-4 md:flex-row md:gap-6">
                    {{-- Saldo comprado --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Monto de saldo de compra</span>
                        </label>
                        <input type="text" placeholder="Q0.00" class="w-full max-w-xs input input-bordered" />
                    </div>

                    {{-- Saldo anterior --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Monto de saldo anterior</span>
                        </label>
                        <input type="text" placeholder="Q0.00" class="w-full max-w-xs input input-bordered" />
                    </div>

                    {{-- Monto de factura --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Monto de factura</span>
                        </label>
                        <input type="text" placeholder="Q0.00" class="w-full max-w-xs input input-bordered" />
                    </div>

                    {{-- Detalles --}}
                    <div class="justify-center flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Detalle</span>
                        </label>
                        <input type="text" placeholder="Escriba alguna descripcion..."
                            class="w-full max-w-xs input input-bordered" />
                    </div>
                </div>
                <button class="w-full btn btn-info">
                    Save
                </button>
            </div>

            <div class="flex flex-col flex-1 gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
                <div class="flex flex-col items-center justify-center w-full gap-4 p-5 overflow-hidden md:gap-6">
                    <div class="flex flex-col items-center w-full gap-4 md:flex-row md:gap-6">
                        {{-- sucursal --}}
                        <div class="justify-center flex-1 form-control">
                            <label class="label">
                                <span class="label-text-alt">Sucursal</span>
                            </label>
                            <select class="select select-bordered">
                                <option disabled selected>Seleccione una sucursal</option>
                                <option>Star Wars</option>
                                <option>Harry Potter</option>
                                <option>Lord of the Rings</option>
                                <option>Planet of the Apes</option>
                                <option>Star Trek</option>
                            </select>
                        </div>

                        {{-- telefonia --}}
                        <div class="justify-center flex-1 form-control">
                            <label class="label">
                                <span class="label-text-alt">Telefonia</span>
                            </label>
                            <select class="select select-bordered">
                                <option disabled selected>Seleccione una telefonia</option>
                                <option>Star Wars</option>
                                <option>Harry Potter</option>
                                <option>Lord of the Rings</option>
                                <option>Planet of the Apes</option>
                                <option>Star Trek</option>
                            </select>
                        </div>

                        {{-- telefono --}}
                        <div class="justify-center flex-1 form-control">
                            <label class="label">
                                <span class="label-text-alt">Telefono</span>
                            </label>
                            <select class="select select-bordered">
                                <option disabled selected>Seleccione un telefono</option>
                                <option>Star Wars</option>
                                <option>Harry Potter</option>
                                <option>Lord of the Rings</option>
                                <option>Planet of the Apes</option>
                                <option>Star Trek</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col items-center w-full gap-4 md:flex-row md:gap-6">
                        {{-- fecha --}}
                        <div class="justify-center flex-1 form-control">
                            <label class="label">
                                <span class="label-text">Desde</span>
                            </label>
                            <input type="date" class="w-full max-w-xs input input-bordered" />
                        </div>

                        {{-- fecha --}}
                        <div class="justify-center flex-1 form-control">
                            <label class="label">
                                <span class="label-text">Hasta</span>
                            </label>
                            <input type="date" class="w-full max-w-xs input input-bordered" />
                        </div>

                        <div class="flex-1 text-center">
                            <button class="btn btn-info">
                                search
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Factura</th>
                                <th>Monto</th>
                                <th>Proveedor</th>
                                <th>Fecha de factura</th>
                                <th>Fecha de ingreso</th>
                                <th>Tipo de factura</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr class="hover">
                                <td>1</td>
                                <td>12345-67890</td>
                                <td>Q3000</td>
                                <td>Selectpharma</td>
                                <td>01-11-2022</td>
                                <td>03-11-2022</td>
                                <td>Contable</td>
                            </tr>
                            <!-- row 2 -->
                            <tr class="hover">
                                <td>2</td>
                                <td>67890-12345</td>
                                <td>Q4000</td>
                                <td>Bryan Monterroso</td>
                                <td>02-11-2022</td>
                                <td>03-11-2022</td>
                                <td>No Contable</td>
                            </tr>
                            <!-- row 3 -->
                            <tr class="hover">
                                <td>3</td>
                                <td>12345-67890</td>
                                <td>Q5000</td>
                                <td>Varios</td>
                                <td>03-11-2022</td>
                                <td>03-11-2022</td>
                                <td>Contable</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>