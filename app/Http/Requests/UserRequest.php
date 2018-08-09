<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        $validate = [
            'name' => 'required|string|max:255',
            'role' => 'required',
        ];
        
        # email and password are only required on creation
        if ($this->isMethod("POST"))
        {
            $validate['email'] = 'required|string|email|max:255|unique:users';
            $validate['password'] = 'required|string|min:6|confirmed';
        }
        return $validate;
    }
}
