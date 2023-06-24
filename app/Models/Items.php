<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
use App\Models\Laboratories;

class Items extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ["codebar", "name", "category_id", "laboratory_id", "generic"];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratories::class, 'laboratory_id');
    }

}
