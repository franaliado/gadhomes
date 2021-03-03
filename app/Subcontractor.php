<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    //
    public function houses(){
        return $this->hasMany('App\House');
    }
}
