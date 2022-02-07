<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreItemsInventories extends Model
{
    use HasFactory;
    use SoftDeletes;

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
