<div class="flex flex-col object-center gap-4 px-4 py-2 mx-auto overflow-hidden md:flex-row lg:px-8 md:pt-0 xl:gap-6">

    <div class="w-full p-5 overflow-hidden text-center bg-white shadow-md md:basis-1/3 lg:basis-1/4 sm:rounded-lg">


        <section x-data="{ generarFactura: false, generarComprobante: true, hiddenElement: false, hiddenElement2: false }"
            class="flex flex-col gap-8">

            {{-- <div>
                <a href="#choose_items_modal" class="btn btn-secondary">
                    Buscar productos
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                    </svg>
                </a>
            <div> --}}

            <x-w-button rounded info lg icon="search" label="Buscar" href="#choose_items_modal" />

            @if (session()->has('errorSaveSale'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('errorSaveSale') }}
                </div>
            @endif

            @if (session()->has('successSaveSale'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('successSaveSale') }}
                </div>
            @endif

            @if (session()->has('notProductsSale'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    {{ session('notProductsSale') }}
                </div>
            @endif

            <div class="shadow stats">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                    </div>
                    <div class="stat-title">Numero de registro</div>
                    <div class="stat-value">{{ $saleId }}</div>
                </div>
            </div>

            <section class="flex flex-col gap-4 xl:flex-row">
                <div class="flex-1 text-center">
                    <div class="w-full shadow stats">
                        <div class="w-full stat place-items-center">
                            <div class="stat-title">Total</div>
                            <div class="stat-value text-primary">Q {{ $total }}</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-1 gap-4 md:flex-col">
                    <div class="px-1 rounded-full form-control hover:bg-slate-200">
                        <label class="gap-2 cursor-pointer label">
                            <span class="label-text">Generar factura</span>
                            <input type="checkbox" class="checkbox checkbox-info" x-model="generarFactura"
                                x-on:click="generarComprobante = !!generarFactura; hiddenElement = !generarFactura; hiddenElement2 = !generarFactura" />
                        </label>
                    </div>

                    <div class="px-1 rounded-full form-control hover:bg-slate-200">
                        <label class="gap-2 cursor-pointer label">
                            <span class="label-text">Generar comprobante</span>
                            <input type="checkbox" class="checkbox checkbox-info" x-model="generarComprobante"
                                x-on:click="generarFactura = !!generarComprobante; hiddenElement = !!generarComprobante; hiddenElement2 = !!generarComprobante" />
                        </label>
                    </div>
                </div>
            </section>

            <section class="flex flex-col gap-6">
                <x-w-button rounded xl icon="shopping-cart" x-bind:class="{ 'hidden': hiddenElement }" positive label="Vender" wire:click="vender" />
                <div class="flex flex-wrap justify-center gap-6 md:flex-row">
                    <x-w-button rounded flat outline indigo icon="printer" label="Imprimir" />
                    @if(count($listProducts) > 0)
                        <x-w-button rounded flat outline icon="x" negative label="Cancelar" wire:click='cancelSale' />
                    @endif
                    {{-- <x-w-button rounded md blue icon="save" label="Guardar" wire:click='saveSale' /> --}}
                    {{-- <x-w-button rounded md orange icon="receipt-tax" label="Guardar e imprimir" /> --}}
                </div>
            </section>

            <section class="p-4 bg-blue-100 bg-opacity-70 rounded-xl">
                <details class="collapse collapse-plus">
                    <summary class="text-2xl font-bold text-center collapse-title">Datos de Cliente</summary>
                    <div class="collapse-content">
                        <div class="flex flex-col py-4">
                            <div class="flex-1 w-full form-control" x-bind:class="{'hidden': !hiddenElement2}">
                                <label class="label">
                                    <span class="label-text">NIT de cliente</span>
                                </label>
                                <div x-data="{ nit: '{{ $nitClient }}', nitError: false, nitErrorMessage: '' }">
                                    <input wire:model='nitClient' value="{{ $nitClient }}" x-model="nit" type="text"
                                        pattern="^((?:[0-9]+|[0-9]+K|CF))$"
                                        title="El NIT debe ser un número o 'CF', o un número seguido de 'K' al final"
                                        placeholder="CF" class="w-full max-w-xs input input-bordered"
                                        x-on:input="validateNit" />
                                    <div x-show="nitError" class="text-xs text-red-500" x-text="nitErrorMessage"></div>
                                </div>
                            </div>

                            <div class="flex-1 w-full form-control" x-bind:class="{ 'hidden': hiddenElement }">
                                <label class="label">
                                    <span class="label-text">Nombre de cliente</span>
                                </label>
                                <div>
                                    <input type="text" placeholder="Consumidor Final"
                                        class="w-full max-w-xs input input-bordered" value="{{ $nameClient }}" />
                                </div>
                            </div>

                            <div class="flex-1 w-full form-control" x-bind:class="{ 'hidden': hiddenElement }">
                                <label class="label">
                                    <span class="label-text">Direccion de cliente</span>
                                </label>
                                <div>
                                    <input type="text" placeholder="Ciudad" class="w-full max-w-xs input input-bordered"
                                        value="{{ $addressClient }}" />
                                </div>
                            </div>
                        </div>

                        <button wire:click="buscarCliente" class="btn btn-outline w-full md:w-[50%]"
                            x-bind:class="{ 'hidden': hiddenElement }">
                            Buscar cliente
                        </button>
                    </div>
                </details>

                {{-- <h1 class="text-2xl font-bold text-center text-slate-400">Datos de cliente</h1> --}}


            </section>

            <a href="#" class="text-center hover:underline">
                Registro de facturas/comprobantes
            </a>
        </section>

    </div>

    <div class="p-5 overflow-hidden text-center bg-white shadow-md md:basis-2/3 lg:basis-3/4 md:gap-6 sm:rounded-lg">

        <div class="mt-4 overflow-x-auto">

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Presentación</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($listProducts)
                        @foreach ($listProducts as $key => $product)
                            @livewire('market.seller.sale.table-item', ['product' => $product, 'key' => $key], key($key))
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function validateNit() {
            let nit = this.nit.trim(); // Eliminar espacios en blanco en cualquier posición

            // Eliminar puntos (.) si hay caracteres diferentes a un punto o si es diferente a un único punto
            if (nit.replace(/[^\w\s]|_/g, '').length !== 1 || nit !== '.') {
                nit = nit.replace(/\./g, '');
            }

            nit = nit.replace(/_/g, ''); // Eliminar guiones (altos o bajos) en la anteúltima posición
            nit = nit.replace(/k$/, 'K'); // Reemplazar "k" minúscula por "K" mayúscula en la última posición

            // Reemplazar "C/F" o "CONSUMIDOR FINAL" por "CF" en mayúsculas
            nit = nit.replace(/C\/F|CONSUMIDOR FINAL/i, 'CF');

            const pattern = /^((?:[0-9]+|[0-9]+K|CF))$/; // Expresión regular para validar el formato del NIT

            this.nit = nit; // Actualizar el valor del NIT depurado

            this.nitError = !pattern.test(nit);
            this.nitErrorMessage = this.nitError ? 'El NIT debe ser un número o CF, o un número seguido de K al final' : '';

                if (this.nitError) {
                    this.hiddenElement = true;
                }
                if (!this.nitError && this.nit.length > 0) {
                    this.hiddenElement = false;
                }
                if (this.nit.length === 0) {
                    this.nitError = true;
                    this.nitErrorMessage = '';
                }
        }
    </script>
</div>
