<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'paid',
        'payment_date',
        'value'
      ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function markAsPaid() {
        $this->paid = true;
        $this->save();
    }

    public static function storeMaiorQueZero(array $attributes){
        if($attributes['value'] > 0) {
            //return static::create($attributes);
            $invoice = static::create($attributes);
            $invoice->markAsPaid();
            return $invoice;
        }
        return null;
    }
}
