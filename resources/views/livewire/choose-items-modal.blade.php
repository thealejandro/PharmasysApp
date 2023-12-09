<div id="choose_items_modal" class="items-start w-full pt-10 modal">
{{-- <dialog id="choose_items_modal" class="modal"> --}}
    <div class="modal-box md:w-2/4 w-[90%] h-[80%] max-w-full overflow-hidden">
        {{-- <form method="dialog">
            <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
        </form> --}}

        <div class="justify-start mt-0 mb-6 modal-action">
            <a href="#" class="pl-1 text-black normal-case border-none bg-stone-200 hover:bg-stone-300 btn btn-sm">
                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"></path>
                </svg>
                Regresar
            </a>
        </div>

        <h3 class="text-2xl font-bold text-center">Agregar productos</h3>

        <div class="flex flex-col gap-4">
            <input wire:model.lazy='searchTerm' type="text" placeholder="Buscar productos"
                class="w-full p-2 border rounded-md pointer-events-auto" autofocus>

            <div wire:loading wire:target='searchTerm' class="w-full h-full text-center">
                <span class="text-3xl">Buscando...</span>
            </div>

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Genérico</th>
                        <th>Acciones</th> <!-- Nueva columna para el botón "Agregar" -->
                    </tr>
                </thead>
                <tbody>
                    @if (count($filteredProducts) === 0)
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron resultados</td>
                    </tr>
                    @else
                        @foreach ($filteredProducts as $product)
                        <tr class="transition-transform ease-linear cursor-pointer hover hover:scale-[.99]">
                            <td>{{ $product["codigo"] }}</td>
                            <td>{{ $product["categoria"] }} - {{ $product["producto"] }} - {{ $product["marca"] }}</td>
                            <td>Q {{ $product["precio"] }}</td>
                            <td>
                                <div class="collapse collapse-arrow bg-base-200">
                                    <input type="radio" name="my-accordion-2" checked="checked" />
                                    <div class="collapse-title text-xl font-medium">
                                        {{ $product["cantidad1"] + $product["cantidad2"] }}
                                    </div>
                                    <div class="collapse-content">
                                        <ul>
                                            <li>Precio 1 </li>
                                            <li>Precio 2 </li>
                                            <li>Precio 3 </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product["generico"] ? "Si" : "No" }}</td>
                            <td>
                                <x-w-button.circle wire:click="addProduct({{ $product['codigo'] }})" positive icon="view-grid-add" />
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
{{-- </dialog> --}}
</div>
