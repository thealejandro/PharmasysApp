<tr>
    @php
        $presentation = $item->article_data['presentations'][0];
    @endphp
    <td>{{ $item->itemID }}</td>
    <td>{{ $item->name }}, {{ $identifier }}</td>
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
            <select wire:model='presentationKey' class="select select-bordered uppercase">
                @foreach ($item->article_data['presentations'] as $key => $p)
                    <option value="{{ $key }}">
                        {{ $p['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        {{ Helper::GTMoney($subTotal) }}
        <div class="w-full h-auto" wire:loading.block wire:target='quantity, presentationKey'>
            <x-line-loader></x-line-loader>
        </div>
    </td>
    <td class="text-center">
        <button class="btn btn-circle btn-sm hover:bg-red-500 hover:border-red-500 hover:scale-110 hover:animate-spin"
            wire:click='delete'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block w-6 h-6 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </td>
</tr>
