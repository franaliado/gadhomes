<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }
}
