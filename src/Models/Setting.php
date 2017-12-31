<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Setting extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [ 'slug', 'value', 'is_custom' ];

    /**
     * Scope a query to return specific value.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param bool $type
     */
    public function scopeFetch($query, $slug)
    {
        return $query->whereSlug($slug);
    }

    public function scopeCustom($query, $custom=1)
    {
        return $query->whereIsCustom($custom);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
