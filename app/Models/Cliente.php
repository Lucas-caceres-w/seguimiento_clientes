<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['dni', 'telefono', 'asesorado', 'duracion', 'user_id', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
