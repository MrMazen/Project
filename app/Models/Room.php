<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $guarded = [];

    public function sections(){
        return $this->belongsTo('App\Models\Section','section_id','id');
    }
}
