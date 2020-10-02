<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Uploads\UploadTrait;

class PropertyTitleDeed extends Model
{
    use UploadTrait;

    protected $table = 'property_title_deeds';
    public $fillable = [
        'property_id',
        'title_deed_type',
        'title_deed_no',
        'issued_year',
        'parcel_no',
        'image',
    ];

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "properties/title_deed";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }
}
