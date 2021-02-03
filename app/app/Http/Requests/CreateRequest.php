<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|max:20|',
            'detail' => 'required|max:100',
            'fee' => 'required|integer|min:0|max:1000000',
            'imgpath' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'detail' => '詳細',
            'fee' => '値段',
            'imgpath' => '画像',
            'qty' => '数量',
        ];
    }
}
