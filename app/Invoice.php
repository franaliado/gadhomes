<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //Relación Uno a Uno Inverso
    public function invoice(){
        return $this->belongsTo('App\Order');
    }  
}
