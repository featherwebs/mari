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
            'user.name'     => 'required|min:3',
            'user.email'    => 'required|email|unique:users,email',
            'user.username' => 'required|min:3|unique:users,username',
            'user.password' => 'required|min:6|confirmed',
            'user.role.id'  => 'required|exists:roles,id'
        ];
    }

    public function data()
    {
        return [
            'name'      => $this->input('user.name'),
            'email'     => $this->input('user.email'),
            'username'  => $this->input('user.username'),
            'password'  => bcrypt($this->input('user.password')),
            'is_active' => $this->input('user.is_active', 'false') == 'true',
        ];
    }
}
