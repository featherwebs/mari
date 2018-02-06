<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [ 'title', 'slug', 'custom' ];

    protected $casts = [
        'custom' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class);
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
