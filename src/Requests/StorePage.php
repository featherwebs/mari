<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePage extends FormRequest
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
            'page.title'             => 'required|min:3',
            'page.slug'              => 'required|unique:pages,slug',
            'page.sub_title'         => '',
            'page.view'              => '',
            'page.content'           => '',
            'page.page_id'           => 'exists:pages,id|nullable',
            'page.images.*.id'       => '',
            'page.images.*.image_id' => '',
            'page.images.*.file'     => 'mimetypes:image/jpeg,image/png,image/jpg,image/bmp|max:5120|dimensions:max_width=3840,max_height=2160',
        ];
    }

    public function data()
    {
        return [
            'title'            => $this->input('page.title'),
            'sub_title'        => $this->input('page.sub_title'),
            'slug'             => str_slug($this->input('page.slug')),
            'view'             => $this->input('page.view', 'default'),
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
            if ($custom['type'] != 'post-type' && $custom['type'] != 'post-type-multiple' && array_key_exists('slug', $custom)) {
                if (array_key_exists('slug', $custom)) {
                    $slug   = $custom['slug'];
                    $values = [];

                    if (array_key_exists('value', $custom)) {
                        if ( ! is_array($custom['value'])) {
                            $values = [ $custom['value'] ];
                        } else {
                            $values = $custom['value'];
                        }
                    }

                    foreach ($values as $value) {
                        array_push($data, [
                            'slug'  => $slug,
                            'value' => $value,
                        ]);
                    }
                }
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
                $slug   = $custom['slug'];
                $values = [];

                if (array_key_exists('value', $custom)) {
                    if (is_array($custom['value'])) {
                        $values = $custom['value'];
                    } else {
                        $values = [ $custom['value'] ];
                    }
                }

                foreach ($values as $value) {
                    array_push($data, [
                        'slug'  => $slug,
                        'value' => $value,
                    ]);
                }
            }
        }

        return $data;
    }
}
