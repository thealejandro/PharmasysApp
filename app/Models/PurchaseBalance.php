<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseBalance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [];

    // protected $table = 'invoices';
    // protected $fillable = [
    //     'invoice_number',
    //     'amount',
    //     'supplier',
    //     'invoice_date',
    //     'entry_date',
    //     'invoice_type',
    // ];
}
