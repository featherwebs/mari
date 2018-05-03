<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
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
            'post.title'         => 'required|min:3',
            'post.slug'          => 'required|min:3',
            'post.sub_title'     => '',
            'post.view'          => '',
            'post.content'       => '',
            'post.post_type_id'  => 'required|exists:post_types,id',
            'post.images.*.file' => 'image|max:5120|dimensions:max_width=3840,max_height=2160'
        ];
    }

    public function data()
    {
        return [
            'title'            => $this->input('post.title'),
            'sub_title'        => $this->input('post.sub_title'),
            'slug'             => str_slug($this->input('post.slug')),
            'view'             => $this->input('post.view'),
            'content'          => $this->input('post.content'),
            'custom'           => $this->input('post.custom', []),
            'post_type_id'     => $this->input('post.post_type_id'),
            'meta_title'       => $this->input('post.meta_title'),
            'meta_description' => $this->input('post.meta_description'),
            'meta_keywords'    => $this->input('post.meta_keywords'),
            'is_published'     => $this->input('post.is_published', 'false') == 'true',
            'is_featured'      => $this->input('post.is_featured', 'false') == 'true'
        ];
    }

    public function customData()
    {
        if ( ! $this->input('post.custom', false)) {
            return false;
        }

        $data = [];
        foreach ($this->input('post.custom', []) as $custom) {
            if ( ! ( $custom['type'] == 'file' )) {
                if (array_key_exists('slug', $custom)) {
                    array_push($data, [
                        'slug'  => $custom['slug'],
                        'value' => array_key_exists('value', $custom) ? $custom['value'] : ''
                    ]);
                }
            }
        }

        return $data;
    }
}
