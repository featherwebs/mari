<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $fillable = [ 'menu_id', 'title', 'url', 'order', 'custom' ];

    protected $casts = [
        'custom' => 'array',
    ];

    protected $appends = [ 'type' ];

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
    }

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
