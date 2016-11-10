<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerson extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return user()->admin === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'person'        =>  'string|required',
            'drink'         =>  'in:coffee,tea,water|required',
            'sugar'         =>  'in:0,1,2,3,4,5',
            'milk'          =>  'string|required',
            'busy'          =>  'in:1,2,3'
        ];
    }
}
