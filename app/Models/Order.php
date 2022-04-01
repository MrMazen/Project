<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id','id');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room','Room_id','id');
    }
}
