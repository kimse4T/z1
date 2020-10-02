<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $table = 'units';

    public function property(){
        return $this->belongsTo('App\Models\Property');
    }
}
