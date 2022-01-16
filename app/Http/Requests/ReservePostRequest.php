<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $paths = [
            'reserve.post'
        ];

        return (in_array($this->route()->action['as'], $paths));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => '',
            'kana' => '',
            'tel'  => '',
            'email' => '',
        ];

        return $rules;
    }
}
