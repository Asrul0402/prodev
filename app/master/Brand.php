<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table ='brands';

    public function Subbrand(){
        return $this->hasMany('App\master\Subbrand');
    }    

    protected $fillable = [
        'brand',
    ];

}
