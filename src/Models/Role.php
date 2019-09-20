<?php

namespace Featherwebs\Mari\Models;

use Zizaco\Entrust\EntrustRole;
use Featherwebs\Mari\Traits\Flushable;

class Role extends EntrustRole
{
    use Flushable;

    protected $guarded = [];

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
