<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{

    protected $table = 'additional';

    protected $fillable = ['id', 'description', 'amount', 'date', 'house_id'];

    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }
}
