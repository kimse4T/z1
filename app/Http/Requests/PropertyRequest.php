<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address'       => 'required',
        ];
    }

    public function validatorBuilding($keyBuilding = [], $validator){
        foreach($keyBuilding as $key){
            if(is_array($this->{$key})){
                if(count(array_filter($this->{$key})) != count($this->{$key})){
                    $replaceKey = str_replace('unit',' ', str_replace('_',' ', $key));
                    $validator->errors()->add($key, 'The ' .$replaceKey. ' field is required');
                }
            }
        }
    }

    public function validationField($field,$value,$validator){
        if (!$value) {
            $validator->errors()->add($field, 'The '.$field.' is required!');
        }
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->is_appraisal) {
                // $this->validationField('type',$this->type,$validator);
                // $this->validationField('land_width',$this->land_width,$validator);
                // $this->validationField('current_use',$this->current_use,$validator);
                // $this->validationField('land_area',$this->land_area,$validator);
                $this->validatorBuilding([
                    'unit_storey',
                    'unit_gross_floor_area',
                    'unit_completion_year',
                    'unit_name',
                    'unit_floor',
                    'unit_area'
                ], $validator);
                // foreach((array)json_decode($this->propertyTitleDeedRepeatable) as $item){
                //     if((array)$item['title_deed_type']==''){

                //         $validator->errors()->add('title_deed_type', 'The title_deed_type is required!');
                //     }
                // }
                $propertyTitleDeeds = json_decode($this->propertyTitleDeedRepeatable,true);
                foreach($propertyTitleDeeds as $titleDeep){
                    // dd($titleDeep['title_deed_type'] == '');
                    if($titleDeep['title_deed_type'] == ''){
                        $validator->errors()->add('title_deed_type', 'The title deed type field is required.');
                    }
                }
            }
        });
    }



    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
