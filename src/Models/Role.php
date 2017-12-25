<?php

namespace Featherwebs\Mari\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [ 'name', 'display_name' ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function scopeSuperAdmin($query, $is = true)
    {
        if ($is)
        {
            return $query->where('description', '=', 'super-admin');
        }

        return $query->whereNull('description')->orWhere('description', '!=', 'super-admin');
    }
}
