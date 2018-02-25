<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostType extends FormRequest
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
            'title' => 'required|unique:post_types,title|min:3',
        ];
    }

    public function data()
    {
        $customData = [];

        foreach($this->input('custom', []) as $c)
        {
            array_push($customData, [
                "pivot" => [
                    "slug" => strtolower($c['pivot']['slug'])
                ],
                "slug" => strtolower($c['slug']),
                "type" => strtolower($c['type']),
                "title" => $c['title'],
                "default" => $c['default']
            ]);
        }
        

        return [
            'title'  => $this->get('title'),
            'slug'   => str_slug($this->get('title')),
            'custom' => $customData,
            'alias'  => $this->input('alias', []),
        ];
    }
}
