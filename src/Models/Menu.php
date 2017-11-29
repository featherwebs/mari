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
}
