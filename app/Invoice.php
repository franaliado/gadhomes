<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [ 'id', 'num_invoice', 'order_id',  'created_at', 'updated_at'];

    //Relación Uno a Uno Inverso
    public function invoice(){
        return $this->belongsTo('App\Order');
    }  
}
