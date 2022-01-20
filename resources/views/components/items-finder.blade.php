<div class="m-1">
    <div class="form-control">
        <input type="text" class="input input-bordered" placeholder="Buscar productos" wire:model='query'>
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
                    <tr class="hover cursor-pointer hover:scale-95 transition-transform hover:animate-pulse ease-linear"
                        onclick="document.getElementById('close-modal').click()"
                        wire:click="addItem({{ $item->store_items_inventories_id }})">
                        @php
                            $location = $item->article_data['location'];
                            //Retrives the first presentation
                            $presentation = $item->article_data['presentations'][0];
                        @endphp
                        <td>{{ $item->itemID }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity_countable + $item->quantity_uncountable }}</td>
                        <td>{{ $presentation['price'] }}</td>
                        <td>{{ "{$location['estante']} - {$location['nivel']} - {$location['caja']}" }}</td>
                        <td>---</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
