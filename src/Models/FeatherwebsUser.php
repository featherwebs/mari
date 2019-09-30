<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FeatherwebsUser extends Authenticatable
{
    protected $table = 'users';

    use EntrustUserTrait {
        boot as private entrustBoot;
    }
    use RevisionableTrait {
        boot as private revisionableBoot;
    }
    use Notifiable;

    protected $dontKeepRevisionOf = [
        'password',
        'remember_token',
    ];

    protected $revisionFormattedFields = [
        'is_active' => 'boolean:No|Yes',
    ];

    protected $appends = [ 'image' ];

    protected $revisionCreationsEnabled = true;

    public static function boot()
    {
        self::entrustBoot();
        self::revisionableBoot();
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
        static::deleted(function () {
            Cache::flush();
        });
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function getImageAttribute()
    {
        return $this->images()
                    ->first();
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')
                    ->withPivot('slug');
    }

    public function scopeSuperAdmin($query, $is = true)
    {
        $superRole = Role::whereDescription('super-admin')
                         ->first();
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
        $superRole = Role::whereDescription('super-admin')
                         ->first();

        return $this->hasRole($superRole->name);
    }

    public function syncImage(Request $request)
    {
        $this->images()
             ->detach();

        $path = $request->input('user.image');
        $slug = 'photo';

        if ( ! empty($path)) {
            $filename = basename($path);
            $image    = Image::where('path', 'like', '%' . $filename)
                             ->first();
            if ($image) {
                $this->images()
                     ->save($image, [ 'slug' => str_slug($slug, '_') ]);
            }
        }
    }
}
