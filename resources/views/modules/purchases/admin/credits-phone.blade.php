<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Credits Phone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 md:gap-6 object-center overflow-hidden">
            <div class="flex flex-col gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}

                    <h1 class="card-title">Compra de Saldo</h1>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full items-center">
                        {{-- Sucursal --}}
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Fecha de compra</span>
                            </label>
                            <input type="date" class="input input-bordered w-full max-w-xs" />
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full items-center">
                        {{-- Saldo comprado --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de saldo de compra</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Saldo anterior --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de saldo anterior</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Monto de factura --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de factura</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Detalles --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Detalle</span>
                            </label>
                            <input type="text" placeholder="Escriba alguna descripcion..." class="input input-bordered w-full max-w-xs" />
                        </div>
                    </div>
                    <button class="btn btn-info">
                        Save
                    </button>


                {{-- </div> --}}
            </div>

            <div class="flex flex-col gap-4 md:gap-6 bg-white w-full overflow-hidden items-center justify-center p-5 shadow-md sm:rounded-lg">
                {{-- <div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center justify-center"> --}}

                    <h1 class="card-title">Compra de Saldo</h1>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full items-center">
                        {{-- Sucursal --}}
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
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
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Fecha de compra</span>
                            </label>
                            <input type="date" class="input input-bordered w-full max-w-xs" />
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full items-center">
                        {{-- Saldo comprado --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de saldo de compra</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Saldo anterior --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de saldo anterior</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Monto de factura --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Monto de factura</span>
                            </label>
                            <input type="text" placeholder="Q0.00" class="input input-bordered w-full max-w-xs" />
                        </div>

                        {{-- Detalles --}}
                        <div class="flex-1 form-control justify-center">
                            <label class="label">
                                <span class="label-text">Detalle</span>
                            </label>
                            <input type="text" placeholder="Escriba alguna descripcion..." class="input input-bordered w-full max-w-xs" />
                        </div>
                    </div>

                    <button class="btn btn-info">
                        search
                    </button>


                {{-- </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
