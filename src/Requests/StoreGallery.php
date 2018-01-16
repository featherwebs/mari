<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGallery extends FormRequest
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
            'files.*' => 'mimetypes:image/jpeg,image/png,image/jpg,image/bmp|max:2048|dimensions:min_width=1920,min_height=1080'
        ];
    }

    public function data(){
        return [
            'title' => $this->get('title'),
            'slug'  => str_slug($this->get('title')),
            'user_id' => auth()->id()
        ];
    }
}
