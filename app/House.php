<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //Relación Uno a Muchos
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function payment_subcontractors(){
        return $this->hasMany('App\Payment_Subcontractor');
    }


    //Relación Uno a Muchos Inversa
    public function community(){
        return $this->belongsTo('App\Community');
    }

    public function subcontractor(){
        return $this->belongsTo('App\Subcontractor');
    }
}
