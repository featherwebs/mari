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
        return $this->user['id'] == auth()->id() || auth()->user()->can('update-user');
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'user.name'     => 'required|min:3',
            'user.email'    => 'required|email|unique:users,email,' . $this->user['id'],
            'user.username' => 'required|min:3|unique:users,username,' . $this->user['id'],
            'user.password' => 'confirmed',
            'user.role.id'  => 'nullable|exists:roles,id'
        ];
    }

    public function data()
    {
        $data = [
            'name'      => $this->input('user.name'),
            'email'     => $this->input('user.email'),
            'username'  => $this->input('user.username'),
            'is_active' => $this->input('user.is_active', 0) == 1,
        ];

        if ( ! empty($this->input('user.password'))) {
            $data['password'] = bcrypt($this->input('user.password'));
        }

        return $data;
    }
}
