<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\StoreItemsInventories;

class InventoryTableOfStores extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Store items inventories id", "store_items_inventories_id")
                ->sortable(),
            Column::make("ItemID", "itemID")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Quantity countable", "quantity_countable")
                ->sortable(),
            Column::make("Quantity uncountable", "quantity_uncountable")
                ->sortable(),
            Column::make("Article data", "article_data")
                ->sortable(),
            Column::make("Identifier", "identifier")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return StoreItemsInventories::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.inventory_table_of_stores';
    }
}
