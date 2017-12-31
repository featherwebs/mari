<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class FeatherwebsUser extends Authenticatable
{
    protected $table = 'users';

    use EntrustUserTrait {
        boot as private entrustBoot;
    }
    use Notifiable;
    use RevisionableTrait {
        boot as private revisionableBoot;
    }

    protected $dontKeepRevisionOf = [
        'password',
        'remember_token'
    ];

    protected $revisionFormattedFields = [
        'is_active' => 'boolean:No|Yes'
    ];

    protected $revisionCreationsEnabled = true;

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function scopeSuperAdmin($query, $is = true)
    {
        $superRole = Role::whereDescription('super-admin')->first();
        if ( ! $superRole) {
            return $query;
        }

        $supers = $superRole->users->pluck('id');

        if ($is) {
            return $query->whereIn('id', $supers);
        }

        return $query->whereNotIn('id', $supers);
    }

    public function isSuperAdmin()
    {
        $superRole = Role::whereDescription('super-admin')->first();

        return $this->hasRole($superRole->name);
    }

    public static function boot()
    {
        self::entrustBoot();
        self::revisionableBoot();
        parent::boot();
    }
}
