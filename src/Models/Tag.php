<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
