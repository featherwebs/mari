<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedia extends FormRequest
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
            'files.*' => 'mimetypes:image/jpeg,image/png,image/jpg,image/bmp|max:2048|dimensions:max_width=1920,max_height=1080'
        ];
    }

    public function messages()
    {
        return [
            'files.*.mimetypes'  => 'Invalid image format. Only JPG, PNG and BMP filetypes are supported',
            'files.*.max'        => 'Images should not be more than 2MB',
            'files.*.dimensions' => 'Images should be 1920x1080 px or less',
        ];
    }
}
