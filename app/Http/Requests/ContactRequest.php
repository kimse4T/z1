<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        // dd(request());
        return $this->apiRules();
    }

    public static function apiRules()
    {
        return [
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:30',
            'last_name'  => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:30',
            'salutation' => 'required',
            'type'       => 'required|regex:/^[a-zA-Z]+$/u',
            'phone'      => 'required',
            'email'      => 'sometimes|nullable|email',
            'identity_card' => 'sometimes|nullable|numeric'
        ];
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
