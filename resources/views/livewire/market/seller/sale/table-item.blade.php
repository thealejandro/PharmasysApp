<tr>
    <td>{{ $product["id"] }}</td>
    <td>{{ $product["name"] }}</td>
    {{-- <td class=""> {{ $isBadQuantity || $isOutOfStock ? 'bg-red-300 border-red-500 border transition-colors animate-pulse' : '' }}
        <div class="form-control">
            <input type="number"
                class="input input-bordered {{-- {{ $isBadQuantity || $isOutOfStock ? 'border-red-500' : '' }} "
                placeholder="cantidad" wire:model.lazy='quantity' min="1" value="1">
        </div> --}}
        {{-- @if ($isBadQuantity)
            <div class="mt-1 text-sm font-bold">Cantidad inválida</div>
        @endif
        @if ($isOutOfStock)
            <div class="mt-1 text-sm font-bold">Productos insuficientes</div>
        @endif --}}

        {{-- <x-w-inputs.number /> --}}
    {{-- </td> --}}
    {{-- <td>{{ $product["quantity"] }}</td> --}}
    {{-- <td> --}}
        {{-- <div x-data="{ count: 1 }" class="flex items-center gap-x-1">
            <x-w-button x-hold.click.repeat.200ms="count--" icon="minus" />

            <input type="number" class="bg-teal-600 text-white px-5 py-1.5" x-bind:value="count"></input>
            <span class="bg-teal-600 text-white px-5 py-1.5" x-text="count"></span>

            <x-w-button x-hold.click.repeat.200ms="count++" icon="plus" />
        </div> --}}
    {{-- </td> --}}
    <td>
        <x-w-input type="number" min="1" wire:model.lazy="quantity" />
    </td>
    <td>
        <x-w-native-select wire:model="presentationId">
            @foreach($product["presentation"] as $presentations)
                <option value="{{ $presentations["idpresentacion"] }}">{{ $presentations["presentacion"] }}</option>
            @endforeach
        </x-w-native-select>
    </td>
    <td>{{ $price }}</td>
    <td>{{ $subtotal }}</td>
    <td>
        <x-w-button.circle negative icon="trash" wire:click='removeItem({{ $product["code"] }})' />
    </td>
</tr>
