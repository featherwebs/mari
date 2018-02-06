<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenu extends FormRequest
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
            'menu.title' => 'required',
            'menu.slug'  => 'required|min:3'
        ];
    }

    public function data()
    {
        return [
            'title'  => $this->input('menu.title'),
            'slug'   => $this->input('menu.slug'),
            'custom' => $this->input('menu.custom')
        ];
    }
}
