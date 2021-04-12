<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $uploads = '/photos/';

    protected $fillable = ['img'];

    public function getFileAttribute($image){
        return $this->uploads . $image;
    }
}
