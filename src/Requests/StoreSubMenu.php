<?php

namespace Featherwebs\Mari\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubMenu extends FormRequest
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
            'sub_menu' => 'required|array|min:1'
        ];
    }

    public function data()
    {
        $order  = 1;
        $result = [];
        foreach ($this->input('sub_menu') as $item)
        {
            array_push($result, [
                'menu_id' => $this->menu->id,
                'order'   => $order,
                'title'   => empty($item['title']) ? '' : $item['title'],
                'url'     => empty($item['url']) ? '' : $item['url'],
            ]);
            $order ++;
        }

        return $result;
    }
}
