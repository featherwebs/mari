<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostType extends FormRequest
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
        if ($this->route()->getName() == 'admin.post-type.store') {
            $validation = 'post_types,title';
        } else {
            $validation = 'page_types,title';
        }

        return [
            'title' => 'required|min:3|unique:' . $validation,
        ];
    }

    public function data()
    {
        $customData = [];

        foreach ($this->input('custom', []) as $c) {
            array_push($customData, [
                'pivot'   => [
                    'slug' => strtolower($c['pivot']['slug']),
                ],
                'slug'    => strtolower($c['slug']),
                'type'    => strtolower($c['type']),
                'title'   => $c['title'],
                'default' => $c['default'],
                'id'      => array_key_exists('id', $c) ? $c['id'] : '',
                'options' => array_key_exists('options', $c) ? $c['options'] : [],
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
