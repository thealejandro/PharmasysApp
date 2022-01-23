<div>
    <div class="form-control mb-2">
        <input type="text" class="input input-bordered" wire:model.lazy='query' placeholder="Buscar productos">
    </div>
    <div class="w-full h-auto" wire:loading>
        <x-line-loader></x-line-loader>
    </div>
    <div class="overflow-x-auto max-h-[30rem] overflow-y-auto">
        <table class="table table-compact w-full">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>C. Contable</th>
                    <th>C. No Contable</th>
                    <th>P. de venta</th>
                    <th>Vencimiento</th>
                    <th>P. de compra</th>
                    <th>Ubicación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->itemID }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity_countable }}</td>
                        <td>{{ $item->quantity_uncountable }}</td>
                        <td>{{ Helper::GTMoney($item->article_data['presentations'][0]['price']) }}</td>
                        <td>
                            {{ empty($item->article_data['expiry_date']) ? 'Sin caducidad' : $item->article_data['expiry_date'] }}
                        </td>
                        <td>{{ Helper::GTMoney($item->article_data['price_purchase']) }}</td>
                        <td>
                            {{ $item->article_data['location']['estante'] }} -
                            {{ $item->article_data['location']['nivel'] }} -
                            {{ $item->article_data['location']['caja'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
