<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    //
    public function houses(){
        return $this->hasMany('App\House');
    }
}
