<?php

namespace Featherwebs\Mari\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        'view',
        'is_published',
        'is_featured'
    ];

    protected $appends = [ 'url' ];
    protected $casts = [
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
        'created_at'   => 'date'
    ];

    protected $revisionFormattedFields = [
        'is_published' => 'boolean:No|Yes'
    ];

    protected $revisionFormattedFieldNames = [
        'is_published' => 'Published Status'
    ];

    public function custom()
    {
        return $this->morphMany(CustomField::class, 'customable');
    }

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
        return $this->morphToMany(File::class, 'fileable')->withPivot('slug');
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

    public function syncImages(Request $request)
    {
        $this->images()->detach();

        foreach ($request->input('post.images', []) as $k => $img) {
            $path = $request->input('post.images.' . $k . '.path');
            $slug = $request->input('post.images.' . $k . '.pivot.slug');

            if ( ! empty($path)) {
                $filename = basename($path);
                $image = Image::where('path', 'like', '%'.$filename)->first();
                if($image)
                    $this->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
            }
        }
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
        if ($custom = $this->custom()->where('slug', $slug)->first()) {
            return $custom->value;
        }

        return $default;
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

    public function getFile($slug = false, $obj = false)
    {
        if ( ! $slug) {
            return $this->files;
        }

        $file = $this->files()->whereSlug($slug)->first();

        if ($file) {
            if ( ! $obj) {
                return $file->url;
            } else {
                return $file;
            }
        }

        return false;
    }

    public function scopeType($query, $slugid)
    {
        if(is_array($slugid))
            $arr = $slugid;
        else
            $arr = [$slugid];

        return $query->where(function($q) use ($arr) {
            foreach($arr as $item) {
                $id       = $item;
                $postType = PostType::whereSlug($item)->first();
                if ($postType) {
                    $id = $postType->id;
                }
    
                $q->orWhere('post_type_id', $id);
            }
        });
        
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

    public function delete()
    {
        $this->custom()->delete();

        parent::delete();
    }

    public function getUrlAttribute()
    {
        return route('post', $this->slug);
    }
}
