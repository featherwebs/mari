<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class FeatherwebsUser extends Authenticatable
{
    use EntrustUserTrait
    {
        boot as private entrustBoot;
    }
    use Notifiable;
    use RevisionableTrait
    {
        boot as private revisionableBoot;
    }

    protected $dontKeepRevisionOf = [
        'password', 'remember_token'
    ];

    protected $revisionFormattedFields = [
        'is_active' => 'boolean:No|Yes'
    ];

    protected $revisionCreationsEnabled = true;

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public static function boot()
    {
        self::entrustBoot();
        self::revisionableBoot();
        parent::boot();
    }
}