<?php

namespace Featherwebs\Mari\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Post extends Model
{
    use RevisionableTrait;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'post_type_id',
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
        'is_featured'
    ];

    protected $casts = [
        'custom'       => 'json',
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
        'created_at'   => 'date'
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

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class);
    }

    public function syncTags($data)
    {
        $ids = [];
        if ( ! is_array($data)) {
            return;
        }
        foreach ($data as $t) {
            $tag = Tag::where('title', $t)->orWhere('slug', str_slug($t))->first();
            if ( ! $tag) {
                $tag = Tag::create([ 'title' => $t, 'slug' => str_slug($t) ]);
            }
            array_push($ids, $tag->id);
        }

        $this->tags()->sync(array_values($ids));
    }

    public function scopePublished($query, $isPublished = true)
    {
        return $query->where('is_published', $isPublished);
    }

    public function scopeFeatured($query, $isFeatured = true)
    {
        return $query->where('is_featured', $isFeatured);
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

    public function getImage($slug = false)
    {
        if ( ! $slug) {
            return $this->images;
        }

        return $this->images()->wherePivot('slug', $slug)->first();
    }

    public function scopeType($query, $id)
    {
        return $query->where('post_type_id', $id);
    }

    public function setSlugAttribute($value)
    {
        $count  = '';
        $slug   = $value;
        $exists = true;
        while ( $exists) {

            if($this->exists)
                $exists = self::where('slug', $slug)->where('id', '!=', $this->id)->count() > 0;
            else {
                $exists = self::where('slug', $slug)->count() > 0;
            }

            if ($exists) {
                $count = intval($count) + 1;
                $slug = $value . '-' . intval($count);
            }
        }

        $this->attributes['slug'] = $slug;
    }
}
