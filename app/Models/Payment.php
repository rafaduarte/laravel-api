<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_date'
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function isValidAmount()
    {
        return $this->amount > 0;
    }
}
