<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    protected $table = 'pkp_promo';
    protected $primaryKey ='id_pkp_promo';

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    
    public function departement2(){
        return $this->hasOne('App\users\Departement','id','tujuankirim2');
    }

    public function users(){
        return $this->hasOne('App\user','id','userpenerima');
    }

    public function not(){
        return $this->hasOne('App\pkp\notulen','id_promo','id_pkp_promo');
    }

    public function users2(){
        return $this->hasOne('App\user','id','userpenerima2');
    }

    public function datapromo(){
        return $this->hasOne('App\pkp\data_promo','id_pkp_promoo','id_pkp_promo');
    }
}
