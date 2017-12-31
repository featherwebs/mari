<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'email'    => 'required|email|unique:users,email,' . $this->user->id,
            'username' => 'required|min:3|unique:users,username,' . $this->user->id,
            'password' => 'confirmed',
            'role.id'  => 'nullable|exists:roles,id'
        ];
    }

    public function data()
    {
        $data = [
            'name'      => $this->get('name'),
            'email'     => $this->get('email'),
            'username'  => $this->get('username'),
            'is_active' => $this->get('is_active', 'false') == 'true',
        ];

        if ( ! empty($this->get('password'))) {
            $data['password'] = bcrypt($this->get('password'));
        }

        return $data;
    }
}
