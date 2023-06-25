<div class="flex flex-col object-center gap-4 px-6 py-4 mx-auto overflow-hidden max-w-7xl lg:px-8 md:py-8 md:gap-6">
    <div class="flex flex-col items-center justify-center gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
        <div class="flex flex-col items-center justify-center w-full gap-4 px-4 md:flex-row">
            <div class="flex-1 pt-2 text-center">
                <a href="#choose-items-modal">
                    <button class="btn btn-secondary">
                        Buscar productos
                    </button>
                </a>
            </div>

            <div class="flex-1 text-center">
                <div class="shadow stats">
                    <div class="stat place-items-center">
                        <div class="stat-title">Total</div>
                        <div class="stat-value text-primary">Q0.00</div>
                    </div>
                </div>
            </div>

            <div class="flex-1 text-center">
                <div class="gap-2 p-3 form-control hover:bg-slate-200 hover:rounded-full">
                    <label class="cursor-pointer label">
                        <span class="label-text">Generar factura</span>
                        <input type="checkbox" class="checkbox checkbox-info" />
                    </label>
                </div>

                <div class="gap-2 p-3 form-control hover:bg-slate-200 hover:rounded-full">
                    <label class="cursor-pointer label">
                        <span class="label-text">Generar comprobante</span>
                        <input type="checkbox" checked="checked" class="checkbox checkbox-info" />
                    </label>
                </div>
            </div>

            <div class="flex flex-row justify-center flex-1 gap-4 md:gap-8">
                <button wire:click="vender" class="text-white btn btn-primary">
                    Vender
                </button>
                <button class="text-white btn btn-error">
                    Cancelar
                </button>
                <button class="text-white btn btn-info">
                    Imprimir
                </button>
                <br>
                <a href="{{ route("module.market.seller.invoice.record") }}">
                    <button class="text-white btn btn-accent">
                        Registro de facturas
                    </button>
                </a>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full gap-4 px-4 py-4 md:flex-row bg-slate-300 rounded-2xl">
            <div class="flex-1 w-full max-w-xs form-control">
                <label class="label">
                    <span class="label-text">NIT de cliente</span>
                    <span class="label-text-alt">CF: por defecto</span>
                </label>
                <div x-data="{ nit: '{{ $nitClient }}', nitError: false, nitErrorMessage: '' }">
                    <input wire:model.lazy="nitClient" x-model="nit" type="text"pattern="^((?:[0-9]+|[0-9]+K|CF))$" title="El NIT debe ser un número o 'CF', o un número seguido de 'K' al final" placeholder="CF" class="w-full max-w-xs input input-bordered" x-on:input.debounce.500ms="validateNit" />
                    <div x-show="nitError" class="text-xs text-red-500" x-text="nitErrorMessage"></div>
                </div>
            </div>
            <div class="flex-1 w-full max-w-xs form-control">
                <label class="label">
                    <span class="label-text">Nombre de cliente</span>
                    <span class="label-text-alt">Consumidor Final: por defecto</span>
                </label>
                <input type="text" placeholder="Consumidor Final" class="w-full max-w-xs input input-bordered" />
            </div>
            <div class="flex-1 w-full max-w-xs form-control">
                <label class="label">
                    <span class="label-text">Direccion de cliente</span>
                    <span class="label-text-alt">Ciudad: por defecto</span>
                </label>
                <input type="text" placeholder="Ciudad" class="w-full max-w-xs input input-bordered" />
            </div>

            <button class="btn btn-info">
                Consultar NIT
            </button>
        </div>
    </div>

    <div class="flex flex-col gap-4 p-5 overflow-hidden bg-white shadow-md md:gap-6 sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="table w-full">
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
                    {{-- {{ gettype($selectedProducts) }} --}}
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
        }
    </script>
</div>
