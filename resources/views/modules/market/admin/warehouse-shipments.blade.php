<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse Shipments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 py-4 flex flex-col gap-4 md:gap-6 object-center overflow-hidden">
            <div class="flex flex-col gap-4 md:gap-6 bg-white p-5 shadow-md overflow-hidden items-center justify-center sm:rounded-lg">

                {{-- Inicio de modal --}}
                <div id="choose-items-modal" class="modal w-full items-start pt-10">
                    <div class="modal-box md:w-2/3 w-[90%] h-[90%] max-w-full">
                        {{-- {{ $content ?? '' }} --}}
                    </div>
                    <div class="modal-action">
                        {{-- {{ $actions ?? '' }} --}}
                        <a href="#" class="btn btn-circle bg-red-700">X</a>
                    </div>
                </div>
                {{-- Final de modal --}}

                <div class="flex flex-col md:flex-row gap-4 md:gap-8 lg:gap-16 px-4 w-full items-center justify-center">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Seleccione alguna sucursal</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Sucursal a enviar</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    <div class="text-center pt-2">
                        <a href="#choose-items-modal">
                            <button class="btn btn-secondary">
                                Buscar productos
                            </button>
                        </a>
                    </div>

                    <button class="btn btn-secondary">
                        Guardar copia de seguridad
                    </button>
                </div>

                <div class="flex flex-col md:flex-row gap-4 px-4 w-full items-center justify-center">

                    <div class="flex-1 text-center">
                        <div class="stats shadow">
                            <div class="stat place-items-center">
                                <div class="stat-title">Total</div>
                                <div class="stat-value text-primary">Q0.00</div>
                            </div>

                            <div class="stat place-items-center">
                                <div class="stat-title">Registro de envio</div>
                                <div class="stat-value text-secondary">400</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 text-center hover:bg-slate-200 hover:rounded-full p-3">
                        <div class="form-control">
                            <label class="cursor-pointer label gap-6">
                                <span class="label-text">Generar factura</span>
                                <input type="checkbox" checked="checked" class="checkbox checkbox-info" />
                            </label>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-row gap-4 md:gap-8 justify-center">
                        <button class="btn btn-primary text-white">
                            Vender
                        </button>
                        <button class="btn btn-error text-white">
                            Cancelar
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 px-4 w-full items-center justify-center bg-slate-300 py-4 rounded-2xl">
                    <div class="flex-1 form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">NIT de cliente</span>
                            <span class="label-text-alt">CF: por defecto</span>
                        </label>
                        <input type="text" placeholder="CF" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="flex-1 form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Nombre de cliente</span>
                            <span class="label-text-alt">Consumidor Final: por defecto</span>
                        </label>
                        <input type="text" placeholder="Consumidor Final" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="flex-1 form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Direccion de cliente</span>
                            <span class="label-text-alt">Ciudad: por defecto</span>
                        </label>
                        <input type="text" placeholder="Ciudad" class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 md:gap-6 bg-white p-5 shadow-md sm:rounded-lg overflow-hidden">
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