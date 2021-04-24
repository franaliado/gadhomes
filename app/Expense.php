<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

     protected $fillable = [ 'id', 'type_expense', 'date', 'description', 'type_pay', 'card', 'amount', 'user_id'];

    //Relación Uno a Muchos Inversa
    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
