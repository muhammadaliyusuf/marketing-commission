<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function marketing()
    {
        return $this->belongsTo(Marketing::class, 'marketing_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'sale_id');
    }
}
