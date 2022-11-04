<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Records') }}
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

                    {{-- numero --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Numero de factura</span>
                        </label>
                        <input type="text" placeholder="Numero de factura" class="input input-bordered w-full max-w-xs" />
                    </div>

                    {{-- Codigo/nombre del item --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text">Codigo/Nombre de producto</span>
                        </label>
                        <input type="text" placeholder="Codigo/Nombre de producto" class="input input-bordered w-full max-w-xs" />
                    </div>

                    {{-- categoria --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Categoria</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione una categoria</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
                    </div>

                    {{-- marca --}}
                    <div class="flex-1 form-control">
                        <label class="label">
                            <span class="label-text-alt">Marca</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Seleccione una marca</option>
                            <option>Star Wars</option>
                            <option>Harry Potter</option>
                            <option>Lord of the Rings</option>
                            <option>Planet of the Apes</option>
                            <option>Star Trek</option>
                        </select>
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

            <div class="flex-1 flex flex-col bg-white p-5 shadow-md sm:rounded-lg overflow-hidden">
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
