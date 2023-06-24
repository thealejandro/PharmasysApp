<div id="choose-items-modal" class="items-start w-full pt-10 modal">
    <div class="modal-box md:w-2/4 w-[90%] h-[80%] max-w-full overflow-hidden">
        <div class="justify-start mt-0 mb-6 modal-action">
            <a href="#" class="pl-1 text-black normal-case border-none bg-stone-200 hover:bg-stone-300 btn btn-sm">
                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                </svg>
                Regresar
            </a>
        </div>

        <div class="flex flex-col gap-4">
            <input wire:model.lazy='searchTerm' type="text" placeholder="Buscar productos" class="w-full p-2 border rounded-md pointer-events-auto" autofocus>

            <div wire:loading wire:target='searchTerm' class="w-full h-full text-center">
                <span class="text-3xl">Buscando...</span>
            </div>

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio de venta</th>
                        <th>Genérico</th>
                        <th>Acciones</th> <!-- Nueva columna para el botón "Agregar" -->
                    </tr>
                </thead>
                <tbody>
                    @if (count($filteredProducts) === 0)
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron resultados</td>
                    </tr>
                    @endif
                    @foreach ($filteredProducts as $product)
                    <tr class="transition-transform ease-linear cursor-pointer hover hover:scale-[.99]">
                        <td>{{ $product->barcode }}</td>
                        <td>{{ $product->category->name }} - {{ $product->name }} - {{ $product->laboratory->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->generic }}</td>
                        <td>
                            <button wire:click="addProduct({{ $product->id }})" class="btn btn-primary">Agregar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
