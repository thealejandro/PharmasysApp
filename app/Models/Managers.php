<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Managers extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'user_approve_id'];

    // Relación con el usuario asociado al gerente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el usuario que aprobó al gerente
    public function approver()
    {
        return $this->belongsTo(User::class, 'user_approve_id');
    }
}
