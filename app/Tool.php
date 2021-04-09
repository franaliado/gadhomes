<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{

    protected $table = 'tools';

    protected $fillable = ['id', 'description', 'amount', 'date', 'house_id'];

    //Relación Uno a Muchos Inversa
    public function subcontractor(){
        return $this->hasOne('App\Subcontractor', 'id', 'subcontractor_id');
    }
}
