<div class="m-1">
    @php
        $total = array_reduce($itemsStructure, fn($c, $i) => ($c += $i['subTotal']));
    @endphp
    <div class="flex justify-center items-center my-2 gap-2">
        <div class="badge badge-success badge-lg text-lg">
            Total: {{ Helper::GTMoney($total) }}
        </div>
    </div>
    <div class="w-full h-auto text-center" wire:loading>
        <x-line-loader></x-line-loader>
    </div>

    @php
        $allUnits = array_map(fn($i) => $i['units'], $itemsStructure);
    @endphp
    @if (!in_array(-1, $allUnits) && count($itemsStructure) > 0)
        <div class="flex justify-evenly items-center py-2" wire:loading.remove>
            <button class="btn btn-primary" wire:click='sell'>
                Vender
            </button>
            <label for="invoiceGenerate" class="flex items-center">
                <x-jet-checkbox id="invoiceGenerate" wire:model="invoiceGenerate"/>
                <span class="ml-2 text-sm text-gray-600">Generar Factura</span>
            </label>
            <button class="btn btn-accent" wire:click='cancel'>
                Cancelar
            </button>
        </div>
        <div class="flex items-center justify-evenly">
            <div class="flex gap-2 items-center">
                <x-jet-label for="invoiceNIT" value="NIT" />
                <x-jet-input id="invoiceNIT" type="text" wire:model="invoiceNIT" />
            </div>
            <div class="flex gap-2 items-center">
                <x-jet-label for="invoiceName" value="Nombre" />
                <x-jet-input id="invoiceName" type="text" wire:model="invoiceName"/>
            </div>
            <div class="flex gap-2 items-center">
                <x-jet-label for="invoiceAddress" value="Direccion" />
                <x-jet-input id="invoiceAddress" type="text" wire:model="invoiceAddress"/>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table table-compact w-full">
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
                @foreach ($items as $key => $item)
                    <livewire:sales-table-item :item="$item" wire:key="item-to-sale-{{ $item->itemID * $key }}"
                        :identifier="$item->identifier" />
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // window.addEventListener('requestPrintPOS', event => {
    //     fetch("http://localhost:8080", {
    //         method: "POST",
    //         body: JSON.stringify(event.detail.dataPrintPOS),
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         // referrer: "about:client",
    //         // referrerPolicy: "no-referrer-when-downgrade",
    //         mode: "no-cors"
    //     })
    //     .then(res => console.log(res.json()))
    //     // .then(res => res.json())
    //     // .catch(err => console.error("Error: ", err))
    //     // .then(response => console.log("Success: ", response));
    // })

    // window.addEventListener("SKL", event => {
    //     console.log("ksl");
    // })
</script>
