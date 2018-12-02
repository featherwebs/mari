<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [ 'title', 'slug' ];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
