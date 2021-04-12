<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_id',
        'is_active',
        'role',
        'fname',
        'lname',
        'email',
        'mobile',
        'password',
        'password_backup',
        'dob',
        'gender',
        'address',
        'state',
        'country',
        'accnum',
        'acctype',
        'accbal',
        'pin',
        'payment_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function image(){
        return $this->belongsTo(Image::class);
    }

    public function transfer(){
        return $this->hasMany(Transfer::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
