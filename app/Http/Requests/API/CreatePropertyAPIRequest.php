<?php

namespace App\Http\Requests\API;

use App\Models\Property;
use InfyOm\Generator\Request\APIRequest;

class CreatePropertyAPIRequest extends APIRequest
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
            'land_width'=> 'sometimes|nullable|numeric',
            'land_length'=> 'sometimes|nullable|numeric',
            'land_area'=> 'sometimes|nullable|numeric',
            'title_deed_type'=> 'required|string',
            'title_deed_no'  => 'sometimes|nullable|numeric',
            'issued_year'   => 'sometimes|nullable|numeric',
            'parcel_no' =>'sometimes|nullable|numeric',
            'total_size_by_title_deed' => 'sometimes|nullable|numeric',
            'unit_name' => 'sometimes|nullable|string',
            'unit_width' => 'sometimes|nullable|numeric',
            'unit_length' => 'sometimes|nullable|numeric',
            'unit_total_size' => 'sometimes|nullable|numeric',
            'unit_gross_floor_area' => 'sometimes|nullable|numeric',
            'unit_bedroom'  => 'sometimes|nullable|numeric',
            'unit_bathroom' => 'sometimes|nullable|numeric',
            'unit_livingroom'  =>'sometimes|nullable|numeric',
            'unit_floor'  =>'sometimes|nullable|numeric',
            'unit_storey'   =>'sometimes|nullable|numeric',
            'unit_car_parking'    =>'sometimes|nullable|numeric',
            'unit_motor_parking'  =>'sometimes|nullable|numeric',
            'unit_cost_estimates'  =>'sometimes|nullable|numeric',
            'unit_usefull_life'  =>'sometimes|nullable|numeric',
            'unit_effective_age'  =>'sometimes|nullable|numeric',
            'unit_completion_year'  =>'sometimes|nullable|numeric',
            'sale_price_asking'  =>'sometimes|nullable|numeric',
            'sale_price_asking_per_sqm'   =>'sometimes|nullable|numeric',
            'sale_price'  =>'sometimes|nullable|numeric',
            'sale_price_per_sqm'  =>'sometimes|nullable|numeric',
            'sale_list_price'  =>'sometimes|nullable|numeric',
            'sale_list_price_per_sqm'   =>'sometimes|nullable|numeric',
            'sold_price'  =>'sometimes|nullable|numeric',
            'sold_price_per_sqm'  =>'sometimes|nullable|numeric',
            'sale_commission'  =>'sometimes|nullable|numeric',
            'rent_price_asking'  =>'sometimes|nullable|numeric',
            'rent_price_asking_per_sqm'  =>'sometimes|nullable|numeric',
            'rent_price'  =>'sometimes|nullable|numeric',
            'rent_price_per_sqm'  =>'sometimes|nullable|numeric',
            'rent_list_price'  =>'sometimes|nullable|numeric',
            'rent_list_price_per_sqm'  =>'sometimes|nullable|numeric',
            'rented_price'  =>'sometimes|nullable|numeric',
            'rented_price_per_sqm'  =>'sometimes|nullable|numeric',
            'rental_cmmission'  =>'sometimes|nullable|numeric',


        ];
    }
}
