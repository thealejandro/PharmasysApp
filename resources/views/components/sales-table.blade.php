<div class="m-1">
    @php
        $total = array_reduce($itemsStructure, fn($c, $i) => ($c += $i['subTotal']));
    @endphp
    <div class="flex justify-center items-center my-2">
        <div class="badge badge-success badge-lg text-lg">
            Total: {{ Helper::GTMoney($total) }}
        </div>
    </div>
    <div class="w-full h-auto" wire:loading>
        <x-line-loader></x-line-loader>
    </div>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Presentación</th>
                    <th>Subtotal</th>
                    <th class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <livewire:sales-table-item :item="$item" wire:key="item-to-sale-{{ $item->itemID }}" />
                @endforeach
            </tbody>
        </table>
    </div>
    @php
        $allUnits = array_map(fn($i) => $i['units'], $itemsStructure);
    @endphp
    @if (!in_array(-1, $allUnits) && count($itemsStructure) > 0)
        <div class="flex justify-end" wire:loading.remove>
            <button class="btn btn-primary w-1/4" wire:click.prevent='sell'>
                Vender
            </button>
        </div>
    @endif
</div>
