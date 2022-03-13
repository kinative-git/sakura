<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUpdateLog extends Model
{
    protected $guarded=[];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
