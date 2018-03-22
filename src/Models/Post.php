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

    public function syncImages(Request $request)
    {
        $this->images()->detach();

        foreach ($request->input('post.images', []) as $k => $img) {
            $id    = $request->input('post.images.' . $k . '.id');
            $image = $request->file('post.images.' . $k . '.file');
            $slug = $request->input('post.images.' . $k . '.pivot.slug');

            if ($image && $image instanceof UploadedFile) {
                fw_upload_image($image, $this, $single = false, $slug);
            } elseif ( ! empty($id)) {
                $image = Image::find($id);
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

    public function getImage($slug = false)
    {
        if ( ! $slug) {
            return $this->images;
        }

        return $this->images()->wherePivot('slug', $slug)->first();
    }

    public function scopeType($query, $slugid)
    {
        $id = $slugid;

        $postType = PostType::whereSlug($slugid)->first();
        if($postType)
            $id = $postType->id;
            
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

    public function delete()
    {
        $this->custom()->delete();

        parent::delete();
    }
}
