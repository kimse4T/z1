<?php

namespace App\Models;

use App\Libraries\Uploads\UploadTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Property extends Model
{
    use CrudTrait;
    use UploadTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'properties';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    public $fillable = [
        'ref_id',
        'salesforce_id',
        'last_sync_modify',
        'project_building',
        'polygon',
        'contact_id',
        'owner_id',
        'name',
        'sale_price_asking',
        'sale_price',
        'sale_list_price',
        'sold_price',
        'rent_price_asking',
        'rent_price',
        'rent_list_price',
        'rented_price',
        'street_no',
        'house_no',
        'address',
        'full_address',
        'zip_postalcode',
        'latitude',
        'longitude',
        'published_by',
        'published_at',
        'land_width',
        'land_length',
        'land_area',
        'land_area_by_title_deed',
        'building_width',
        'building_length',
        'building_height',
        'building_area',
        'title_deed_no',
        'parcel_no',
        'issued_year',
        'description',
        'note',
        'record_type',
        'data_source_type',
        'zone_type',
        'title_deed_type',
        'land_shape_type',
        'site_position',
        'tenure_type',
        'facing_type',
        'label_type',
        'type',
        'created_by',
        'updated_by',
        'stories',
        'current_use',
        'topography',
        'functional_utilities',
        'main_street',
        'manager_id',
        'video_embadded',
        'prefix',
        'code',
        'unit_total_bedroom',
        'unit_total_bathroom',
        'unit_total_livingroom',
        'unit_total_floor',
        'unit_total_parking',
        'unit_total_car_parking',
        'unit_total_motor_parking',
        'unit_total_diningroom',
        'unit_total_doors',
        'is_rent',
        'is_sale',
        'is_appraisal',
        'request_indication_for_listing',
        'indication_min_price',
        'indication_max_price',
        'location_grade',
        'gallery',
        'image',
        'image_left_side',
        'image_right_side',
        'image_back_side',
        'image_opposite',
        'surrounding',
        'listing_id',
        'sale_price_asking_date',
        'sale_price_asking_updated_by',
        'sale_price_date',
        'sale_price_updated_by',
        'sale_list_price_date',
        'sale_list_price_updated_by',
        'sold_price_date',
        'sold_price_updated_by',
        'rent_price_asking_date',
        'rent_price_asking_updated_by',
        'rent_price_date',
        'rent_price_updated_by',
        'rent_list_price_date',
        'rent_list_price_updated_by',
        'rented_price_date',
        'rented_price_updated_by',

        'sale_asking_price_per_sqm',
        'sale_price_per_sqm',
        'sale_list_price_per_sqm',
        'sold_price_per_sqm',
        'rent_asking_price_per_sqm',
        'rent_price_per_sqm',
        'rent_list_price_per_sqm',
        'rented_price_per_sqm',

        'indication_price_date',
        'indication_price_updated_by',
        'property_code',
        'land_document',
        'title_deed_photos',
        'status',
        'rating',
        'agreement_type',
        'agreement_file',
        'agreement_sign_date',
        'agreement_expired_date',
        'rental_cmmission',
        'sale_commission',
        'total_size_by_title_deed',
        ];

    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'id' => 'integer',
        'ref_id' => 'string',
        'ref_resource' => 'string',
        'project_building' => 'string',
        'property_feature_id' => 'integer',
        'contact_id' => 'integer',
        'owner_id' => 'integer',
        'name' => 'string',

        'sale_price_asking' => 'double',
        'sale_price' => 'double',
        'sale_list_price' => 'double',
        'sold_price' => 'double',
        'rent_price_asking' => 'double',
        'rent_price' => 'double',
        'rent_list_price' => 'double',
        'rented_price' => 'double',

        'sale_asking_price_per_sqm' => 'double',
        'sale_price_per_sqm' => 'double',
        'sale_list_price_per_sqm' => 'double',
        'sold_price_per_sqm' => 'double',
        'rent_asking_price_per_sqm' => 'double',
        'rent_price_per_sqm' => 'double',
        'rent_list_price_per_sqm' => 'double',
        'rented_price_per_sqm' => 'double',

        'sale_price_asking_updated_by' => 'string',
        'sale_price_updated_by' => 'string',
        'sale_list_price_updated_by' => 'string',
        'sold_price_updated_by' => 'string',
        'rent_price_asking_updated_by' => 'string',
        'rent_price_updated_by' => 'string',
        'rent_list_price_updated_by' => 'string',
        'rented_price_updated_by' => 'string',

        'street_no' => 'string',
        'house_no' => 'string',
        'address' => 'string',
        'zip_postalcode' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
        'listing_id' => 'integer',
        'published_at' => 'datetime',
        'published_by' => 'integer',
        'unit_total_bedroom' => 'integer',
        'unit_total_bathroom' => 'integer',
        'unit_total_livingroom' => 'integer',
        'unit_total_floor' => 'integer',
        'unit_total_parking' => 'integer',
        'unit_total_car_parking' => 'integer',
        'unit_total_motor_parking' => 'integer',
        'unit_total_diningroom' => 'integer',
        'unit_total_doors' => 'integer',
        'land_width' => 'double',
        'land_length' => 'double',
        'land_area' => 'double',
        'land_area_by_title_deed' => 'double',
        'building_width' => 'double',
        'building_length' => 'double',
        'building_height' => 'double',
        'title_deed_no' => 'string',
        'parcel_no' => 'string',
        'issued_year' => 'double',
        'note' => 'string',
        'location_grade' => 'string',
        'record_type' => 'string',
        'data_source_type' => 'string',
        'zone_type' => 'string',
        'title_deed_type' => 'string',
        'land_shape_type' => 'string',
        'site_position' => 'string',
        'tenure_type' => 'string',
        'facing_type' => 'string',
        'label_type' => 'string',
        'type' => 'string',
        'image' => 'string',
        'image_left_side' => 'string',
        'image_right_side' => 'string',
        'image_back_side' => 'string',
        'image_opposite' => 'string',
        'gallery' => 'array',
        'land_document' => 'array',
        'title_deed_photos' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'stories' => 'integer',
        'is_rent' => 'boolean',
        'is_sale' => 'boolean',
        'is_appraisal' => 'boolean',
        'request_indication_for_listing' => 'boolean',
        'indication_min_price' => 'double',
        'indication_max_price' => 'double',
        'prefix' => 'string',
        'code' => 'string',
        'current_use' => 'string',
        'topography' => 'string',
        'functional_utilities' => 'string',
        'main_street' => 'string',
        'manager_id' => 'integer',
        'video_embadded' => 'text',
        'sale_price_asking_date' => 'datetime',
        'sale_price_date' => 'datetime',
        'sale_list_price_date' => 'datetime',
        'sold_price_date' => 'datetime',
        'rent_price_asking_date' => 'datetime',
        'rent_price_date' => 'datetime',
        'rent_list_price_date' => 'datetime',
        'rented_price_date' => 'datetime',
        'surrounding' => 'string',
        'property_code' => 'string',
        'status' =>'string',
        'rating' => 'double',
        'agreement_type' => 'string',
        'agreement_file' => 'array',
        'agreement_sign_date' => 'datetime',
        'agreement_expired_date' => 'datetime',
        'rental_cmmission' => 'string',
        'sale_commission' => 'string',
        'total_size_by_title_deed' => 'double',
        'polygon' => 'json'
        ];



    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function khAddress()
    {
        return $this->belongsTo('App\Address', 'address', '_code');
    }

    public function contact(){
        return $this->belongsTo('App\Models\Contact','contact_id','id');
    }

    public function owner(){
        return $this->belongsTo('App\Models\Contact','owner_id','id');
    }

    public function titledeeds(){
        return $this->hasMany('App\PropertyTitleDeed');
    }

    public function units(){
        return $this->hasMany('App\Unit');
    }

    public function listing(){
        return $this->hasMany('App\Models\Listing');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Tasks_activity');
    }

    public function setGalleryAttribute($values)
    {
        //dd($values);
        //$disk = 'uploads';
        $attribute_name = "gallery";
        $destination_path = "properties/gallery";
        $this->myCrudUploads($values, $attribute_name, $destination_path);
    }

    public function setAgreementFileAttribute($values)
    {
        $attribute_name = "agreement_file";
        $destination_path = "properties/agreement_file";
        $this->myCrudUploads($values, $attribute_name, $destination_path);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $destination_path = "properties/img/front";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    public function setImageLeftSideAttribute($value)
    {
        $attribute_name = "image_left_side";
        $destination_path = "properties/img/left";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    public function setImageRightSideAttribute($value)
    {
        $attribute_name = "image_right_side";
        $destination_path = "properties/img/right";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    public function setImageBackSideAttribute($value)
    {
        $attribute_name = "image_back_side";
        $destination_path = "properties/img/back";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    public function setImageOppositeAttribute($value)
    {
        $attribute_name = "image_opposite";
        $destination_path = "properties/img/opposite";
        $this->myCrudUpload($value, $attribute_name, $destination_path);
    }

    // public function setImageAttribute($value)
    // {
    //     dd($value);
    //     $attribute_name = "image";
    //     // or use your own disk, defined in config/filesystems.php
    //     $disk = config('backpack.base.root_disk_name');
    //     // destination path relative to the disk above
    //     $destination_path = "public/properties/img";

    //     // if the image was erased
    //     if ($value==null) {
    //         // delete the image from disk
    //         \Storage::disk($disk)->delete($this->{$attribute_name});

    //         // set null in the database column
    //         $this->attributes[$attribute_name] = null;
    //     }

    //     // if a base64 was sent, store it in the db
    //     if (Str::startsWith($value, 'data:image'))
    //     {
    //         // 0. Make the image
    //         $image = \Image::make($value)->encode('jpg', 90);

    //         // 1. Generate a filename.
    //         $filename = md5($value.time()).'.jpg';

    //         // 2. Store the image on disk.
    //         \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

    //         // 3. Delete the previous image, if there was one.
    //         \Storage::disk($disk)->delete($this->{$attribute_name});

    //         // 4. Save the public path to the database
    //         // but first, remove "public/" from the path, since we're pointing to it
    //         // from the root folder; that way, what gets saved in the db
    //         // is the public URL (everything that comes after the domain name)
    //         $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
    //         $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
    //     }
    // }







    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function propertyTitleDeeds()
    {
        return $this->hasMany('App\PropertyTitleDeed');
    }

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

    public function getPropertyFullAddressAttribute()
    {
        $address = [];
        if ($this->house_no) {
            $address[] = '#' . $this->house_no;
        }
        if ($this->street_no) {
            $address[] = 'St.' . $this->street_no;
        }

        $fullAddress = optional($this->khAddress)->FullAddress;
        if ($fullAddress) {
            $address[] = trim($fullAddress);
        }
        return implode(', ', $address);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
