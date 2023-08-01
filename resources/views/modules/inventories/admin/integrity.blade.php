<x-app-layout>
    <x-slot name="header">
        {{ __('Integrity Inventory') }}
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col items-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8">

            <div class="flex justify-between w-full">
                <select class="w-full max-w-xs select">
                    <option disabled selected>Sucursal</option>
                    <option>Homer</option>
                    <option>Marge</option>
                    <option>Bart</option>
                    <option>Lisa</option>
                    <option>Maggie</option>
                </select>

                <div class="form-control">
                    <div class="input-group">
                        <input type="text" placeholder="{{ __(" Search item...") }}" class="input input-bordered" />
                        <button class="btn btn-square">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-lg">
                <div class="flex flex-col w-full md:flex-row">
                    <div class="flex flex-col w-full gap-2 md:flex-row md:justify-between">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->
                                    <tr>
                                        <th>1</th>
                                        <td>Cy Ganderton</td>
                                    </tr>
                                    <!-- row 2 -->
                                    <tr>
                                        <th>2</th>
                                        <td>Hart Hagerty</td>
                                    </tr>
                                    <!-- row 3 -->
                                    <tr>
                                        <th>3</th>
                                        <td>Brice Swyre</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col items-center gap-3">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        Quantity initial after inventory
                                    </span>
                                </label>
                                <label class="input-group input-group-md">
                                    <span>{{ __("Number") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered input-md" />
                                </label>
                            </div>

                            <div class="shadow stats stats-vertical lg:stats-horizontal">
                                <div class="stat">
                                    <div class="stat-title">{{ __("Current Quantity") }}</div>
                                    <div class="stat-value">31</div>
                                    {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                                </div>

                                <div class="stat">
                                    <div class="stat-title">{{ __("Integrity") }}</div>
                                    <div class="stat-value">400</div>
                                    {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                                </div>
                            </div>
                            <button class="w-full btn btn-info">Adjust</button>
                            <div class="divider"></div>
                            <button class="btn btn-ghost btn-sm">Export record item</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Envios --}}
            <div class="w-full overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-lg">
                <h1 class="text-2xl font-bold text-center">Shipping data</h1>
                <div class="flex flex-col w-full md:flex-row">
                    <div class="flex flex-col w-full gap-2 md:justify-between">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Registro</th>
                                        <th>Fecha salida</th>
                                        <th>Fecha recibido</th>
                                        <th>Cantidad</th>
                                        <th>Envio</th>
                                        <th>Recibio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->
                                    <tr>
                                        <th>1</th>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                    </tr>
                                    <!-- row 2 -->
                                    <tr>
                                        <th>2</th>
                                        <td>Hart Hagerty</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                    </tr>
                                    <!-- row 3 -->
                                    <tr>
                                        <th>3</th>
                                        <td>Brice Swyre</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col justify-between w-full gap-3 md:flex-row">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        Edit quantity registry for shipping
                                    </span>
                                </label>
                                <label class="input-group input-group-md">
                                    <span>{{ __("Number") }}</span>
                                    <input type="text" placeholder="0" class="input input-bordered input-md" />
                                </label>
                            </div>

                            <div class="shadow stats stats-vertical lg:stats-horizontal">
                                <div class="stat">
                                    <div class="stat-title">{{ __("Shipments") }}</div>
                                    <div class="stat-value">31</div>
                                    {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                                </div>
                            </div>
                        </div>
                        <button class="w-full btn btn-error">Return and delete</button>
                        <button class="btn btn-ghost">Delete</button>
                    </div>
                </div>
            </div>

            {{-- Ventas --}}
            <div class="w-full overflow-hidden bg-white shadow-xl md:px-6 md:py-6 sm:rounded-lg">
                <h1 class="text-2xl font-bold text-center">Sales data</h1>
                <div class="flex flex-col w-full md:flex-row">
                    <div class="flex flex-col w-full gap-2 md:justify-between">
                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Registro</th>
                                        <th>Fecha Venta</th>
                                        <th>Cantidad</th>
                                        <th>Vendedor</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->
                                    <tr>
                                        <th>1</th>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Q 100.00</td>
                                    </tr>
                                    <!-- row 2 -->
                                    <tr>
                                        <th>2</th>
                                        <td>Hart Hagerty</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Q 100.00</td>
                                    </tr>
                                    <!-- row 3 -->
                                    <tr>
                                        <th>3</th>
                                        <td>Brice Swyre</td>
                                        <td>Cy Ganderton</td>
                                        <td>Cy Ganderton</td>
                                        <td>Q 100.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full gap-3 md:flex-row md:gap-8">
                            <div class="shadow stats stats-vertical lg:stats-horizontal">
                                <div class="stat">
                                    <div class="stat-title">{{ __("Sales") }}</div>
                                    <div class="stat-value">50</div>
                                    {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                                </div>
                            </div>
                            <button class="btn btn-error">Return and delete</button>
                            <button class="btn btn-ghost">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>