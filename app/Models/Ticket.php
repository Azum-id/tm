<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi Ticket belongsTo Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi Ticket hasMany ScanTicket
    public function scanTickets()
    {
        return $this->hasMany(ScanTicket::class);
    }
}
