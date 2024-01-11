<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // Relasi Transaction hasMany Tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relasi Transaction belongsTo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
