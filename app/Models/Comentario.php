<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'comentario',
    ];

    // Relación con el usuario que creó el comentario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
