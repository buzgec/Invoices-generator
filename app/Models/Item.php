<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
