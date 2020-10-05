<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'accounts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [
    //     'photos' => 'array'
    // ];
    public static $rules = [
        'name' => 'required|min:2|max:30',
        'email' =>  'required|email',
        'phone' =>  'required|numeric',
        'industry' =>  'required',
    ];

    public function contact(){
        return $this->belongsToMany('App\Models\Contact');
    }

    public function parent(){
        return $this->hasOne('App\Models\Account','parent_id','id');
    }

}
