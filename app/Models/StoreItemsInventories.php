<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItemsInventories extends Model
{
    use HasFactory;

    protected $casts = [
        'article_data' => 'array'
    ];

    protected $fillable = [
        'store_items_inventories_id',
        'itemID',
        'name',
        'quantity_countable',
        'quantity_uncountable',
        'article_data',
        'identifier',
    ];
}
