<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePage extends FormRequest
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
            'page.title'         => 'required|min:3',
            'page.slug'          => 'required|min:3',
            'page.sub_title'     => '',
            'page.view'          => '',
            'page.content'       => '',
            'page.page_id'       => 'exists:pages,id|nullable',
            'page.images.*.file' => 'image|max:5120|dimensions:max_width=3840,max_height=2160'
        ];
    }

    public function data()
    {
        return [
            'title'            => $this->input('page.title'),
            'sub_title'        => $this->input('page.sub_title'),
            'slug'             => str_slug($this->input('page.slug')),
            'view'             => $this->input('page.view'),
            'content'          => $this->input('page.content'),
            'page_id'          => $this->input('page.page_id'),
            'meta_title'       => $this->input('page.meta_title'),
            'meta_description' => $this->input('page.meta_description'),
            'meta_keywords'    => $this->input('page.meta_keywords'),
            'is_published'     => $this->input('page.is_published', 'false') == 'true',
        ];
    }

    public function customData()
    {
        if ( ! $this->input('page.custom', false)) {
            return false;
        }

        $data = [];
        foreach ($this->input('page.custom', []) as $custom) {
            if ($custom['type'] != 'page-type' && $custom['type'] != 'page-type-multiple' && array_key_exists('slug', $custom)) {
                array_push($data, [
                    'slug'  => array_key_exists('slug', $custom) ? $custom['slug'] : '',
                    'value' => array_key_exists('value', $custom) ? $custom['value'] : '',
                ]);
            }
        }

        return $data;
    }

    public function postsData()
    {
        if ( ! $this->input('page.custom', false)) {
            return false;
        }

        $data = [];
        foreach ($this->input('page.custom', []) as $custom) {
            if (($custom['type'] == 'post-type' || $custom['type'] == 'post-type-multiple') && array_key_exists('slug', $custom)) {
                array_push($data, [
                    'slug'  => array_key_exists('slug', $custom) ? $custom['slug'] : '',
                    'value' => array_key_exists('value', $custom) ? $custom['value'] : [],
                ]);
            }
        }

        return $data;
    }
}
