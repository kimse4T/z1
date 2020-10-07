<?php

namespace App\Http\Requests\API;

use App\Models\Property;
use InfyOm\Generator\Request\APIRequest;

class UpdatePropertyAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address'   => 'required',
            'land_width'=> 'sometimes|nullable|numberic',
            'land_length'=> 'sometimes|nullable|numberic',
            'land_area'=> 'sometimes|nullable|numberic',
            'title_deed_type'=> 'required|string',
            'title_deed_no'  => 'sometimes|nullable|numberic',
            'issued_year'   => 'sometimes|nullable|numberic',
            'parcel_no' =>'sometimes|nullable|numberic',
            'total_size_by_title_deed' => 'sometimes|nullable|numberic',
            'unit_name' => 'sometimes|nullable|string',
            'unit_width' => 'sometimes|nullable|numberic',
            'unit_length' => 'sometimes|nullable|numberic',
            'unit_total_size' => 'sometimes|nullable|numberic',
            'unit_gross_floor_area' => 'sometimes|nullable|numberic',
            'unit_bedroom'  => 'sometimes|nullable|numberic',
            'unit_bathroom' => 'sometimes|nullable|numberic',
            'unit_livingroom'  =>'sometimes|nullable|numberic',
            'unit_floor'  =>'sometimes|nullable|numberic',
            'unit_storey'   =>'sometimes|nullable|numberic',
            'unit_car_parking'    =>'sometimes|nullable|numberic',
            'unit_motor_parking'  =>'sometimes|nullable|numberic',
            'unit_cost_estimates'  =>'sometimes|nullable|numberic',
            'unit_usefull_life'  =>'sometimes|nullable|numberic',
            'unit_effective_age'  =>'sometimes|nullable|numberic',
            'unit_completion_year'  =>'sometimes|nullable|numberic',
            'sale_price_asking'  =>'sometimes|nullable|numberic',
            'sale_price_asking_per_sqm'   =>'sometimes|nullable|numberic',
            'sale_price'  =>'sometimes|nullable|numberic',
            'sale_price_per_sqm'  =>'sometimes|nullable|numberic',
            'sale_list_price'  =>'sometimes|nullable|numberic',
            'sale_list_price_per_sqm'   =>'sometimes|nullable|numberic',
            'sold_price'  =>'sometimes|nullable|numberic',
            'sold_price_per_sqm'  =>'sometimes|nullable|numberic',
            'sale_commission'  =>'sometimes|nullable|numberic',
            'rent_price_asking'  =>'sometimes|nullable|numberic',
            'rent_price_asking_per_sqm'  =>'sometimes|nullable|numberic',
            'rent_price'  =>'sometimes|nullable|numberic',
            'rent_price_per_sqm'  =>'sometimes|nullable|numberic',
            'rent_list_price'  =>'sometimes|nullable|numberic',
            'rent_list_price_per_sqm'  =>'sometimes|nullable|numberic',
            'rented_price'  =>'sometimes|nullable|numberic',
            'rented_price_per_sqm'  =>'sometimes|nullable|numberic',
            'rental_cmmission'  =>'sometimes|nullable|numberic',
        ];
    }
}
