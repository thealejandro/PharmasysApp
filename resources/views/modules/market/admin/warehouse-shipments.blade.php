<x-app-layout>
    <x-slot name="header">
        {{ __('Warehouse Shipments') }}
    </x-slot>

    <div class="py-12">
        <div
            class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-6">
            <div
                class="flex flex-col items-center justify-center gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">

                {{-- Inicio de modal --}}
                <div id="choose-items-modal" class="items-start w-full pt-10 modal">
                    <div class="modal-box md:w-2/3 w-[90%] h-[90%] max-w-full">
                        {{-- {{ $content ?? '' }} --}}
                    </div>
                    <div class="modal-action">
                        {{-- {{ $actions ?? '' }} --}}
                        <a href="#" class="bg-red-700 btn btn-circle">X</a>
                    </div>
                </div>
                {{-- Final de modal --}}

                <div class="flex flex-col items-center justify-center w-full gap-4 px-4 md:flex-row md:gap-8 lg:gap-16">
                    <div class="w-full max-w-xs form-control">
                        <label class="label">
                            <span class="label-text">Seleccione alguna sucursal</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Sucursal a retirar</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    <div class="w-full max-w-xs form-control">
                        <label class="label">
                            <span class="label-text">Seleccione alguna sucursal</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Sucursal a recibir</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    <div class="pt-2 text-center">
                        <a href="#choose-items-modal">
                            <button class="btn btn-secondary">
                                Buscar productos
                            </button>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center w-full gap-4 px-4 md:flex-row">

                    <div class="flex-1 text-center">
                        <div class="shadow stats">
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

                    <div class="flex flex-row justify-center flex-1 gap-4 md:gap-10">
                        <button class="text-white btn btn-primary">
                            Enviar
                        </button>

                        <button class="text-white btn btn-secondary">
                            Imprimir
                        </button>

                        <button class="text-white btn btn-error">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
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