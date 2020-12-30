<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }
}
