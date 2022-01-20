<tr>
    @php
        $presentation = $item->article_data['presentations'][0];
    @endphp
    <td>{{ $item->itemID }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <div class="form-control">
            <input type="number" class="input input-bordered" placeholder="cantidad" wire:model='quantity' min="0">
        </div>
    </td>
    <td>{{ $presentation['price'] }}</td>
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
    <td>{{ $subTotal }}</td>
</tr>
