<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Venturecraft\Revisionable\RevisionableTrait;
use VanOns\Laraberg\Models\Gutenbergable;

class Page extends Model
{
    use RevisionableTrait, Gutenbergable;
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
        'is_published' => 'boolean'
    ];

    protected $appends = [
        'url',
        'content_raw'
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

    public function syncImages(Request $request)
    {
        $this->images()->detach();

        foreach ($request->input('page.images', []) as $k => $img) {
            $path = $request->input('page.images.' . $k . '.path');
            $slug = $request->input('page.images.' . $k . '.pivot.slug');

            if ( ! empty($path)) {
                $filename = basename($path);
                $image = Image::where('path', 'like', '%'.$filename)->first();
                if($image)
                    $this->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
            }
        }
    }

    public function files()
    {
        return $this->morphToMany(File::class, 'fileable')->withPivot('slug');
    }

    public function getContentRawAttribute()
    {
        if(empty($this->content))
            return '<!-- wp:paragraph -->'.$this->content_old.'<!-- /wp:paragraph -->';

        return $this->getRawContent();
    }

    public function renderContent()
    {
        if(empty($this->content))
            return '<!-- wp:paragraph -->'.$this->content_old.'<!-- /wp:paragraph -->';

        return $this->content->render();
    }
}
