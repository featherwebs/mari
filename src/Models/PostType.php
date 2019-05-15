<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $guarded = [];

    protected $casts = [
        'custom' => 'array',
        'alias'  => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getCustom($slug)
    {
        $customCollection = collect($this->custom);

        $custom = $customCollection->where('slug', $slug)->first();
        if (array_key_exists('type', $custom) && array_key_exists('options', $custom) && $custom['type'] == 'select') {
            $custom['options'] = explode(PHP_EOL, $custom['options']);
        }

        return $custom;
    }
}
