<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'vat_number',
        'id_number',
        'checking_account1',
        'checking_account2',
        'checking_account3',
        'checking_account',
        'city',
        'address',
        'phone',
        'email',
        'web'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
