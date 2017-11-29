<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenu extends FormRequest
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
            'title' => 'required',
            'slug'  => 'required|unique:menus,slug'
        ];
    }

    public function data()
    {
        return [
            'title'  => $this->get('title'),
            'slug'   => $this->get('slug'),
            'custom' => $this->input('custom')
        ];
    }
}
