<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }

    //Relación Uno a Uno
    public function invoice(){
        return $this->hasOne('App\Invoice');
    }  
}
