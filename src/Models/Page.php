<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Models\Gutenbergable;
use Venturecraft\Revisionable\RevisionableTrait;
use JordanMiguel\LaravelPopular\Traits\Visitable;

class Page extends Model
{
    use RevisionableTrait, Gutenbergable, Visitable;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'slug',
        'title',
        'sub_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'custom',
        'view',
        'is_published',
        'page_id',
    ];

    protected $casts = [
        'custom'       => 'json',
        'is_published' => 'boolean',
    ];

    protected $appends = [
        'url',
        'lb_raw_content',
    ];

    protected $dontKeepRevisionOf = [
        'custom',
    ];

    protected $revisionFormattedFields = [
        'is_published' => 'boolean:No|Yes',
    ];

    protected $revisionFormattedFieldNames = [
        'is_published' => 'Published Status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrlAttribute()
    {
        return route('page', $this->slug);
    }

    public function getCustom($slug = false, $default = "-")
    {
        if ($custom = $this->custom()->where('slug', $slug)->first()) {
            return $custom->value;
        }

        if($custom = $this->posts()->wherePivot('slug', $slug)->count()) {
            return $this->posts()->wherePivot('slug', $slug)->get();
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

    public function getImage($slug = false, $multiple = false)
    {
        if ( ! $slug) {
            return $this->images;
        }

        $builder = $this->images()->wherePivot('slug', $slug);

        if ($multiple) {
            return $builder->get();
        }

        return $builder->first();
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable')->withPivot('slug');
    }

    public function setSlugAttribute($value)
    {
        $count  = '';
        $slug   = $value;
        $exists = true;
        while ($exists) {

            if ($this->exists) {
                $exists = self::where('slug', $slug)->where('id', '!=', $this->id)->count() > 0;
            } else {
                $exists = self::where('slug', $slug)->count() > 0;
            }

            if ($exists) {
                $count = intval($count) + 1;
                $slug  = $value . '-' . intval($count);
            }
        }

        $this->attributes['slug'] = $slug;
    }

    public function syncImages(Request $request)
    {
        $this->images()->detach();

        foreach ($request->input('page.images', []) as $k => $img) {
            $path = $request->input('page.images.' . $k . '.path');
            $slug = $request->input('page.images.' . $k . '.pivot.slug');

            if ( ! empty($path)) {
                $filename = basename($path);
                $image    = Image::where('path', 'like', '%' . $filename)->first();
                if ($image) {
                    $this->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
                }
            }
        }
    }

    public function pageType()
    {
        return $this->belongsTo(PageType::class, 'view');
    }

    public function files()
    {
        return $this->morphToMany(File::class, 'fileable')->withPivot('slug');
    }

    public function custom()
    {
        return $this->morphMany(CustomField::class, 'customable');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withPivot('slug');
    }

    public function delete()
    {
        $this->custom()->delete();

        parent::performDeleteOnModel();
    }
}
