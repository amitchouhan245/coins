<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Request;

class UserRequest extends FormRequest
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
    public function rules() {

        $userId = Request::segment('3');

        return [

            'name' => "required",
            'email' => "unique:users,email,$userId",
            "mobile_number" => "required|unique:users,mobile_number,$userId",
        ];
    }
}
