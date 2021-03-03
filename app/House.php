<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //
    public function community(){
        return $this->belongsTo('App\Community');
    }

    public function subcontractor(){
        return $this->belongsTo('App\Subcontractor');
    }
}
