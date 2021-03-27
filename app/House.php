<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
 
    protected $table = 'houses';

    protected $fillable = [ 'id', 'address', 'community_id',  'lot', 'status', 'withoutpo', 'start_date', 
                    'subcontractor_id', 'amount_assigned_subc'
   			  ];


    //Relación Uno a Muchos
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function tools(){
        return $this->hasMany('App\Tool');
    }

    public function additional(){
        return $this->hasMany('App\Additional');
    }


    //Relación Uno a Muchos Inversa
    public function community(){
        return $this->hasOne('App\Community', 'id', 'community_id');
    }

    public function subcontractor(){
        return $this->hasOne('App\Subcontractor', 'id', 'subcontractor_id');
    }
}
