<div class="flex flex-col w-full p-10 overflow-hidden bg-white shadow-lg sm:rounded-lg">

    <div class="flex flex-col justify-between w-full md:flex-row">

        <x-w-select
            label="Seleccione una Sucursal"
            placeholder="Sucursales"
            wire:model.defer="model"
            >
            <x-w-select.user-option src="https://via.placeholder.com/500" label="Sucursal 1" value="1" />
            <x-w-select.user-option src="https://via.placeholder.com/500" label="Sucursal 2" value="2" />
            <x-w-select.user-option src="https://via.placeholder.com/500" label="Sucursal 3" value="3" />
            <x-w-select.user-option src="https://via.placeholder.com/500" label="Sucursal 4" value="4" />
        </x-w-select>

        {{-- <select class="w-full max-w-xs select select-ghost">
            <option disabled selected>Sucursales</option>
            <option>Svelte</option>
            <option>Vue</option>
            <option>React</option>
        </select> --}}


        <div class="gap-4 form-control">
            <div class="join">
                <input class="input input-bordered join-item" placeholder="{{ __('Search items') }}" autofocus />
                <button class="btn btn-square join-item" wire:click='searchItems' >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <x-w-button wire:click='showAllItems' icon="clipboard-list" outline rounded primary label="All items" />
        </div>
    </div>

    <div class="w-full py-4 md:py-10">
        <div class="overflow-x-auto">
        {{-- {{ print_r($items) }} --}}
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Cantidad 2</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item["codigo"] }}</th>
                        <td>{{ $item["categoria"] . ' - ' . $item["producto"] . ' - ' . $item["marca"] }}</td>
                        <td>{{ $item["cantidad1"] }}</td>
                        <td>{{ $item["cantidad2"] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
