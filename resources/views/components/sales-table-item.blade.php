<tr>
    @php
        $presentation = $item->article_data['presentations'][0];
    @endphp
    <td>{{ $item->itemID }}</td>
    <td>{{ $item->name }}</td>
    <td
        class="{{ $isBadQuantity || $isOutOfStock ? 'bg-red-300 border-red-500 border transition-colors animate-pulse' : '' }}">
        <div class="form-control">
            <input type="number"
                class="input input-bordered {{ $isBadQuantity || $isOutOfStock ? 'border-red-500' : '' }}"
                placeholder="cantidad" wire:model.lazy='quantity' min="0">
        </div>
        @if ($isBadQuantity)
            <div class="text-sm font-bold mt-1">Cantidad inválida</div>
        @endif
        @if ($isOutOfStock)
            <div class="text-sm font-bold mt-1">Productos insuficientes</div>
        @endif
    </td>
    <td>{{ Helper::GTMoney($price) }}</td>
    <td>
        <div class="form-control">
            <select wire:model='price' class="select select-bordered uppercase">
                @foreach ($item->article_data['presentations'] as $p)
                    <option value="{{ $p['price'] }}">
                        {{ $p['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        {{ Helper::GTMoney($subTotal) }}
        <div class="w-full h-auto" wire:loading.block wire:target='quantity, price'>
            <x-line-loader></x-line-loader>
        </div>
    </td>
</tr>
