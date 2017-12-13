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
        'event_on',
        'is_published',
        'is_featured'
    ];

    protected $casts = [
        'custom'       => 'json',
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
        'created_at'   => 'date'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function delete()
    {
        $this->images()->delete();

        parent::delete();
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
            $tag = Tag::find($t);
            if ( ! $tag) {
                $tag = Tag::create([ 'title' => $t, 'slug' => str_slug($t) ]);
            }
            array_push($ids, $tag->id);
        }

        $this->tags()->sync($ids);
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

        return $this->images()->where('meta', $slug)->first();
    }

    public function scopePast($query, $today = false)
    {
        if ($today) {
            return $query->where('event_on', '<=', date('Y-m-d'));
        }

        return $query->where('event_on', '<', date('Y-m-d'));
    }

    public function scopeUpcoming($query, $today = false)
    {
        if ($today) {
            return $query->where('event_on', '>=', date('Y-m-d'));
        }

        return $query->where('event_on', '>', date('Y-m-d'));
    }

    public function scopeToday($query)
    {
        return $query->where('event_on', '=', date('Y-m-d'));
    }
}
