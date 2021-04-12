<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'user_id',
        'recbank',
        'recaccname',
        'recaccnum',
        'cost_of_transfer',
        'cost_of_transfer_charge',
        'otp',
        'amt',
        'currency_conversion',
        'currency_conversion_charge',
        'tax_revenue',
        'tax_revenue_charge',
        'description',
        'ref',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
