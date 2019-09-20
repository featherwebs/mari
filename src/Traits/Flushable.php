<?php


namespace Featherwebs\Mari\Traits;


use Illuminate\Support\Facades\Cache;

trait Flushable
{
    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
    }
}