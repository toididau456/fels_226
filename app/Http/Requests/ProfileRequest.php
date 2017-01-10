<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'txtName' => 'required|max:50',
            'txtEmail' => 'required|max:60',
            'password' => 'min:6',
            'password_confirm' => 'min:6|same:password',
            'fImage' => 'image'
        ];
    }
}
