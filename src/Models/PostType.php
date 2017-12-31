<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $fillable = [ 'title', 'slug', 'custom', 'alias' ];

    protected $casts = [
        'custom' => 'array',
        'alias'  => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getCustom($slug)
    {
        $customCollection = collect($this->custom);

        $custom = $customCollection->where('slug', $slug)->first();
        if ($custom['type'] == 'select') {
            $custom['options'] = explode(PHP_EOL, $custom['options']);
        }

        return $custom;
    }
}
