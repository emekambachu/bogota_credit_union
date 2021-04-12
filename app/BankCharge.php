<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCharge extends Model
{
    protected $fillable = [
        'currency_conversion',
        'cost_of_transfer',
        'tax_revenue'
    ];
}
