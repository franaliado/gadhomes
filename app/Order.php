<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = [ 'id', 'num_po', 'description',  'option', 'date_order', 'qty_po', 'unit_price', 
                    'name_Superint', 'phone_Superint', 'house_id'
   			  ];

    //Relación Uno a Muchos Inversa
    public function house(){
        return $this->belongsTo('App\House');
    }

    //Relación Uno a Uno
    public function invoice(){
        return $this->hasOne('App\Invoice');
    }  
}
