<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClimate extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $fillable =[
        "type",
        "query",
        "language",
        "unit"
    ];
//-------------------RELACION UNO A MUCHOS (INVERSA)----------
    public function location(){
        return $this->belongsTo('App\Models\Location');
    }

}
