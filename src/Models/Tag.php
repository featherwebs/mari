<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
        static::deleted(function () {
            Cache::flush();
        });
    }
}
