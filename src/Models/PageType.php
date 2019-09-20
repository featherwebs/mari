<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $guarded = [];

    protected $casts = [
        'custom' => 'array',
        'alias'  => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function getCustom($slug)
    {
        $customCollection = collect($this->custom);

        $custom = $customCollection->where('slug', $slug)
                                   ->first();
        if (array_key_exists('type', $custom) && array_key_exists('options', $custom) && $custom['type'] == 'select') {
            $custom['options'] = explode(PHP_EOL, $custom['options']);
        }

        return $custom;
    }
}
