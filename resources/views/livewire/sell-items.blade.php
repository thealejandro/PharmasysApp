<div class="flex flex-col object-center gap-4 px-4 py-2 mx-auto overflow-hidden md:flex-row lg:px-8 md:pt-0 xl:gap-6">

    <div class="w-full p-5 overflow-hidden text-center bg-white shadow-md md:basis-1/3 lg:basis-1/4 sm:rounded-lg">

        <div class="flex flex-col gap-8">
            <section class="flex flex-col gap-4 xl:flex-row">
                <div class="flex-1 text-center">
                    <div class="shadow stats">
                        <div class="stat place-items-center">
                            <div class="stat-title">Total</div>
                            <div class="stat-value text-primary">Q0.00</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-1 gap-4 md:flex-col">
                    <div class="px-1 rounded-full form-control hover:bg-slate-200">
                        <label class="gap-2 cursor-pointer label">
                            <span class="label-text">Generar factura</span>
                            <input type="checkbox" class="checkbox checkbox-info" />
                        </label>
                    </div>

                    <div class="px-1 rounded-full form-control hover:bg-slate-200">
                        <label class="gap-2 cursor-pointer label">
                            <span class="label-text">Generar comprobante</span>
                            <input type="checkbox" checked="checked" class="checkbox checkbox-info" />
                        </label>
                    </div>
                </div>
            </section>

            <section class="flex flex-wrap justify-center gap-4 md:flex-row">
                <button wire:click="vender" class="text-white btn btn-primary">
                    Vender
                </button>
                <button class="text-white btn btn-error">
                    Cancelar
                </button>
                <button class="text-white btn btn-info">
                    Imprimir
                </button>
            </section>

            <section class="p-4 bg-blue-100 bg-opacity-70 rounded-xl">
                <h1 class="text-2xl font-bold text-center text-slate-400">Datos de cliente</h1>
                <div class="flex flex-col py-4">
                    <div class="flex-1 w-full form-control">
                        <label class="label">
                            <span class="label-text">NIT de cliente</span>
                        </label>
                        <div x-data="{ nit: '{{ $nitClient }}', nitError: false, nitErrorMessage: '' }">
                            <input wire:model.lazy="nitClient" x-model="nit" type="text"
                                pattern="^((?:[0-9]+|[0-9]+K|CF))$"
                                title="El NIT debe ser un número o 'CF', o un número seguido de 'K' al final"
                                placeholder="CF" class="w-full max-w-xs input input-bordered"
                                x-on:input.debounce.500ms="validateNit" />
                            <div x-show="nitError" class="text-xs text-red-500" x-text="nitErrorMessage"></div>
                        </div>
                    </div>

                    <div class="flex-1 w-full form-control">
                        <label class="label">
                            <span class="label-text">Nombre de cliente</span>
                        </label>
                        <div>
                            <input type="text" placeholder="Consumidor Final"
                                class="w-full max-w-xs input input-bordered" />
                        </div>
                    </div>

                    <div class="flex-1 w-full form-control">
                        <label class="label">
                            <span class="label-text">Direccion de cliente</span>
                        </label>
                        <div>
                            <input type="text" placeholder="Ciudad" class="w-full max-w-xs input input-bordered" />
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline w-full md:w-[50%]">
                    Buscar cliente
                </button>

            </section>

            <a href="#" class="text-center hover:underline">
                Registro de facturas/comprobantes
            </a>
        </div>

    </div>

    <div class="p-5 overflow-hidden text-center bg-white shadow-md md:basis-2/3 lg:basis-3/4 md:gap-6 sm:rounded-lg">
        <a href="#choose-items-modal" class="btn btn-secondary w-full md:w-[50%]">
            Buscar productos
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </a>

        <div class="mt-4 overflow-x-auto">
            {{-- <table class="table w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Presentación</th>
                        <th>P/U</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($selectedProducts)
                    @foreach ($selectedProducts as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->id }}</td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table> --}}

            <livewire:market-seller-sale-list />
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
        }
    </script>
</div>