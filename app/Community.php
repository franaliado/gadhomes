<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{

    protected $table = 'community';

    protected $fillable = [ 'id', 'name' ];

    public function houses(){
        return $this->hasMany('App\House', 'community_id', 'id');
    }
}
