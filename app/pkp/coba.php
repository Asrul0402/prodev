<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class coba extends Model
{
    protected $table = 'tipu';
    protected $primaryKey ='id';

    public function datapdf(){
        return $this->hasMany('App\pkp\project_pdf','id_project_pdf','pdf_id');
    }

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function kemas(){
        return $this->belongsTo('App\kemas\datakemas','kemas_eksis','id_kemas');
    }
}
