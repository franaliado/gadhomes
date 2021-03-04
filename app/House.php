<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
 
    protected $table = 'house';

    protected $fillable = [ 'id', 'community_id', 'address', 'lot', 'state', '	withopu', 'start_date', 'subcontractor_id',
	    		    'amount_assigned_subc'
   			  ];


    //Relación Uno a Muchos
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function payment_subcontractors(){
        return $this->hasMany('App\Payment_Subcontractor');
    }


    //Relación Uno a Muchos Inversa
    public function community(){
        return $this->hasOne('App\Community', 'id', 'community_id');
    }

    public function subcontractor(){
        return $this->belongsTo('App\Subcontractor');
    }
}
