<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

// una opcion diferente a guarded
    protected $fillable =['name', 'country', 'region', 'lat', 'lon', 'timezone_id', 'localtime', 'localtime_epoch', 'utc_offset'];

    //protected $guarded =[];

//---------------RELACION UNO A MUCHOS CON CLIMATE
    public function climate(){
        return $this->hasMany('app\Models\ModelClimate');
    }

//-----------------RELACION POLIMORFICA UNO A UNO
    public function locationable(){
        return $this->morphTo();
    }


}
