<?php

namespace App\Models;

use App\Libraries\Uploads\UploadTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use CrudTrait;
    use UploadTrait;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'listings';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    public $timestamps = false;
    public $fillable = [
        'ref_id',
        'salesforce_id',
        'last_sync_modify',
        'contact_id',
        'owner_id',
        'sale_list_price',
        'sold_price',
        'rent_price',
        'rent_list_price',
        'rented_price',
        'created_by',
        'updated_by',
        'is_rent',
        'is_sale',
        'status',
        'agreement_type',
        'agreement_file',
        'rental_commission',
        'sale_commission',
        ];

    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'id' => 'integer',
        'ref_id' => 'string',
        'ref_resource' => 'string',
        'contact_id' => 'integer',
        'owner_id' => 'integer',

        'is_rent' => 'boolean',
        'is_sale' => 'boolean',
        'agreement_type' => 'string',
        'agreement_file' => 'array',
        'rental_commission' => 'string',
        'sale_commission' => 'string',
        ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function setAgreementFileAttribute($values)
    {
        $attribute_name = "agreement_file";
        $destination_path = "properties/agreement_file";
        $this->myCrudUploads($values, $attribute_name, $destination_path);
    }

    public function property(){
        return $this->belongsTo('App\Models\Property');
    }

    public function contact(){
        return $this->belongsTo('App\Models\Contact','contact_id','id');
    }

    public function owner(){
        return $this->belongsTo('App\Models\Contact','owner_id','id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
