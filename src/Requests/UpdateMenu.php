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
            'menu.slug'  => 'required|min:3',
            'sub_menu'   => 'required|array|min:1'
        ];
    }

    public function data()
    {
        return [
            'title' => $this->input('menu.title'),
            'slug'  => $this->input('menu.slug')
        ];
    }

    public function subMenuData()
    {
        $order  = 1;
        $result = [];
        foreach ($this->input('sub_menu') as $item)
        {
            array_push($result, [
                'order'   => $order,
                'title'   => empty($item['title']) ? ' ' : $item['title'],
                'url'     => empty($item['url']) ? ' ' : $item['url'],
                'sub_menus' => array_key_exists('sub_menus', $item) ? $item['sub_menus'] : []
            ]);
            $order ++;
        }

        return $result;
    }

    public function subSubMenuData($i)
    {
        $order  = 1;
        $result = [];
        foreach ($this->input('sub_menu.'.$i.'.sub_menus') as $item)
        {
            array_push($result, [
                'order'   => $order,
                'title'   => empty($item['title']) ? ' ' : $item['title'],
                'url'     => empty($item['url']) ? ' ' : $item['url'],
                'sub_menus' => array_key_exists('sub_menus', $item) ? $item['sub_menus'] : []
            ]);
            $order ++;
        }

        return $result;
    }

    public function subSubSubMenuData($i, $j)
    {
        $order  = 1;
        $result = [];
        foreach ($this->input('sub_menu.'.$i.'.sub_menus.'.$j.'.sub_menus') as $item)
        {
            array_push($result, [
                'order'   => $order,
                'title'   => empty($item['title']) ? ' ' : $item['title'],
                'url'     => empty($item['url']) ? ' ' : $item['url'],
                'sub_menus' => array_key_exists('sub_menus', $item) ? $item['sub_menus'] : []
            ]);
            $order ++;
        }

        return $result;
    }
}
