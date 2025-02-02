<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'payment_number',
        'sale_id',
        'amount',
        'payment_method',
        'status',
        'term_length',
        'due_date'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function installments(): HasMany
    {
        return $this->hasMany(PaymentInstallment::class);
    }
}
