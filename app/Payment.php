<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';

    protected $fillable = ['id', 'amount', 'date', 'type', 'house_id'];

    //Relación Uno a Muchos Inversa
    public function subcontractor(){
        return $this->hasOne('App\Subcontractor', 'id', 'subcontractor_id');
    }
}
