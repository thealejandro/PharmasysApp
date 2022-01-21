<div class="m-1">
    <div class="overflow-x-auto">
        <div class="w-full h-auto" wire:loading>
            <x-line-loader></x-line-loader>
        </div>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Presentación</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <livewire:sales-table-item :item="$item" wire:key="item-to-sale-{{ $item->itemID }}" />
                @endforeach
            </tbody>
        </table>
    </div>
</div>
