<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class CustomField extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $guarded = [];

    public function customable()
    {
        return $this->morphTo();
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
