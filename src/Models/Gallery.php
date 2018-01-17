<?php

namespace Featherwebs\Mari\Models;

use Featherwebs\Mari\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [ 'title', 'slug', 'user_id'];

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
