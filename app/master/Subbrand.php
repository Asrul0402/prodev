<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Subbrand extends Model
{
    protected $table = 'subbrands';

    public function Workbook(){
        return $this->hasMany('App\dev\Workbook');
    }
    
    public function Formula(){
        return $this->hasMany('App\dev\Formula');
    }

    public function Brand(){
        return $this->belongsTo('App\master\Brand');    }

    public function User(){
        return $this->belongsTo('App\User');
    }

    protected $fillabble = [
        'subbrand',
        'brand_id',
        'user_id',
    ];

}
