<div class="m-1">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $presentation = $item->article_data['presentations'][0];
                    @endphp
                    <tr>
                        <td>{{ $item->itemID }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <input type="number" class="input input-bordered" placeholder="cantidad" value="1">
                        </td>
                        <td>{{ $presentation['price'] }}</td>
                        <td>
                            <select class="select select-bordered">
                                @foreach ($item->article_data['presentations'] as $presentation)
                                    <option value="{{ $presentation['price'] }}" class="uppercase">
                                        {{ $presentation['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $presentation['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
