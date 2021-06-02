<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = [ 'id', 'num_po', 'date_order', 'type_PO', 'name_Superint', 'phone_Superint', 'paid', 'house_id'
   			  ];

    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }

    public function descriptionpo(){
        return $this->hasMany('App\Descriptionpo');
    }

    //Relación Uno a Uno
    public function invoice(){
        return $this->hasOne('App\Invoice');
    }   
}
