<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Page extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'slug',
        'title',
        'sub_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'content',
        'custom',
        'view',
        'is_published',
        'page_id',
    ];

    protected $casts = [
        'custom'       => 'json',
        'is_published' => 'boolean'
    ];

    protected $appends = [
        'url'
    ];

    protected $dontKeepRevisionOf = [
        'custom'
    ];

    protected $revisionFormattedFields = [
        'is_published' => 'boolean:No|Yes'
    ];

    protected $revisionFormattedFieldNames = [
        'is_published' => 'Published Status'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')->withPivot('slug');
    }

    public function getUrlAttribute()
    {
        return route('page', $this->slug);
    }

    public function getCustom($slug = false, $default = "-")
    {
        $custom = collect($this->custom);
        if ( ! $slug) {
            return $custom;
        }

        if ($custom->where('slug', $slug)->count() > 0
            && array_key_exists('value', $custom->where('slug', $slug)->first())) {
            return $custom->where('slug', $slug)->first()['value'];
        }

        return $default;
    }

    public function scopePublished($query, $isPublished = true)
    {
        return $query->where('is_published', $isPublished);
    }


    public function subPages()
    {
        return $this->hasMany(Page::class, 'page_id');
    }


    public function getImage($slug = false)
    {
        if ( ! $slug) {
            return $this->images;
        }

        return $this->images()->wherePivot('slug', $slug)->first();
    }

}
