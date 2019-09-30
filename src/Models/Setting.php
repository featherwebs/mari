<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Setting extends Model
{
    use RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $guarded = [];

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

    /**
     * Scope a query to return specific value.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param bool $type
     */
    public function scopeFetch($query, $slug)
    {
        return $query->whereSlug($slug);
    }

    public function scopeCustom($query, $custom = 1)
    {
        return $query->whereIsCustom($custom);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')
                    ->withPivot('slug');
    }
}
