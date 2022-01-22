<div class="m-1">
    <div class="form-control">
        <input type="text" class="input input-bordered" placeholder="Buscar productos" wire:model.debounce.500ms='query'>
    </div>
    <div wire:loading wire:target='query' class="w-full h-auto">
        <x-line-loader></x-line-loader>
    </div>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
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
                        //Retrives the first presentation
                        $presentation = $item->article_data['presentations'][0];
                        $stock = $item->quantity_countable + $item->quantity_uncountable;
                        $zeroStock = $stock <= 0 ? 1 : 0;
                    @endphp
                    <tr class="{{ $zeroStock ? 'cursor-not-allowed even:opacity-60 odd:opacity-60' : 'hover cursor-pointer hover:scale-95 transition-transform hover:animate-pulse ease-linear' }}"
                        onclick="document.getElementById('close-modal').click()"
                        wire:click="addItem({{ $item->store_items_inventories_id }}, {{ $zeroStock }}, {{ $presentation['price'] }}, {{ $presentation['quantity'] }})">
                        <td>{{ $item->itemID }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $stock }}</td>
                        <td>{{ Helper::GTMoney($presentation['price']) }}</td>
                        <td>{{ "{$location['estante']} - {$location['nivel']} - {$location['caja']}" }}</td>
                        <td>---</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
