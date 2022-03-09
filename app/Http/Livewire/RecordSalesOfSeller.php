<?php

namespace App\Http\Livewire;

use App\Models\Sellers;
use App\Models\Stores;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalesRecord;

class RecordSalesOfSeller extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("ID", "saleID")
                  ->sortable(),
            Column::make("Facturado", "has_invoice")
                  ->sortable(),
            Column::make("Fecha y Hora", "created_at")
                  ->sortable(),
        ];
    }

    public function query(): Builder
    {
        $seller = Sellers::query()->where("user_id", Auth::id())->latest()->first();
        $store = Stores::query()->where("storeID", $seller->store_id)->first();
        return SalesRecord::query()->where("seller_id", $seller->id)->where("store_id", $store->storeID);
    }
}
