<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{

    protected $table = 'tools';

    protected $fillable = ['id', 'description', 'amount', 'date', 'house_id'];

    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }
}
