<?php

namespace Koya\Http\Requests;

use Auth;

class UserRequest extends Request
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
            'name'     => 'required',
            'username' => 'required|unique:users,username,'.Auth::user()->id,
            'email'    => 'required|email',
        ];
    }
}
