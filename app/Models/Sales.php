<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "user_id",
        "seller_id",
        "store_id",
        "has_invoice",
        "invoice_details",
        "sale_data"
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItems::class);
    }
}
