<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $guarded = [];

    protected $casts = [
        'custom' => 'array'
    ];

    protected $appends = ['type'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function subMenus()
    {
        return $this->morphMany(SubMenu::class, 'submenuable');
    }

    public function getTypeAttribute()
    {
        return 'custom';
    }
}
