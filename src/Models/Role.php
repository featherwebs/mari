<?php

namespace Featherwebs\Mari\Models;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Cache;

class Role extends EntrustRole
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function scopeSuperAdmin($query, $is = true)
    {
        if ($is) {
            return $query->where('description', '=', 'super-admin');
        }

        return $query->whereNull('description')
                     ->orWhere('description', '!=', 'super-admin');
    }
}
