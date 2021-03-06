<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    //

    protected $table = 'subcontractors';

     protected $fillable = [ 'id', 'name', 'phone', 'email' ];

    public function houses(){
        return $this->hasMany('App\House', 'id', 'subcontractor_id');
    }
}
