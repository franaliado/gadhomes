<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = 'payments';

    protected $fillable = ['id', 'amount', 'date', 'type', 'subcontractor_id', 'user_id'];

    //Relación Uno a Muchos Inversa
    public function subcontractor(){
        return $this->hasOne('App\Subcontractor', 'id', 'subcontractor_id');
    }

    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
