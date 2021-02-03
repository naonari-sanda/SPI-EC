<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class AcountRequest extends FormRequest
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
            'zipcode' => 'required|integer|digits:7',
            'prefecture' => 'required|string|max:5',
            'adress' => 'required|string|max:50'
        ];
    }


    public function attributes()
    {
        return [
            'zipcode' => '郵便番号',
            'prefecture' => '都道府県',
            'adress' => '住所'
        ];
    }
}
