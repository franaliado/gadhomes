<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descriptionpo extends Model
{
    protected $table = 'descriptionpo';

     protected $fillable = [ 'id', 'description', 'option', 'qty_po', 'unit_price', 'order_id'];

    //Relación Uno a uno Inversa
    public function orders(){
        return $this->hasOne('App\Order', 'id', 'order_id');
    }
}
