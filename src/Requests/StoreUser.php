<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role.id'  => 'required|exists:roles,id'
        ];
    }

    public function data()
    {
        return [
            'name'      => $this->get('name'),
            'email'     => $this->get('email'),
            'username'  => $this->get('username'),
            'password'  => bcrypt($this->get('password')),
            'is_active' => $this->get('is_active', 'false') == 'true',
        ];
    }
}
