<div class="m-1 overflow-y-hidden">
    <div class="form-control">
        <input type="text" class="input input-bordered" placeholder="Buscar productos" autofocus
            wire:model.lazy='query' />
    </div>
    <div wire:loading wire:target='query' class="w-full h-full text-center">
        <x-line-loader></x-line-loader>
    </div>
    <div class="overflow-x-auto overflow-y-auto">
        <table class="table table-compact w-full">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Categoria - Producto - Laboratorio</th>
                    <th>Existencia</th>
                    <th>Precio</th>
                    <th>Ubicación</th>
                    <th>Genérico</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $location = $item->article_data['location'];
                        $generic = $item->generic == true ? 'Si' : 'No';
                        //Retrives the first presentation
                        $presentation = $item->article_data['presentations'][0];
                        $stock = $item->quantity_countable + $item->quantity_uncountable;
                        $zeroStock = $stock <= 0 ? 1 : 0;
                    @endphp
                    <tr class="{{ $zeroStock? 'cursor-not-allowed even:opacity-60 odd:opacity-60': 'hover cursor-pointer hover:scale-95 transition-transform hover:animate-pulse ease-linear' }}"
                        onclick="document.getElementById('close-modal').click()"
                        wire:click="addItem({{ $item->store_items_inventories_id }}, {{ $zeroStock }}, {{ $presentation['price'] }}, {{ $presentation['quantity'] }}, '{{ $item->name }}')">
                        <td>{{ $item->itemID }}</td>
                        <td>{{ $item->name }}</td>
                        <td onmouseenter="this.classList.add('collapse-open')"
                            onmouseleave="this.classList.remove('collapse-open')">
                            <div class="collapse collapse-arrow">
                                <div class="collapse-title">
                                    {{ $stock }}
                                </div>
                                <div class="collapse-content flex flex-col gap-1">
                                    @foreach ($item->others as $other)
                                        <div>{{ $other->store }} : {{ $other->stock }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td>{{ Helper::GTMoney($presentation['price']) }}</td>
                        <td>{{ $location['estante'] - $location['nivel'] - $location['caja'] }}</td>
                        <td>{{ $generic }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
