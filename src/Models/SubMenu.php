<?php

namespace Featherwebs\Mari\Models;

use Featherwebs\Mari\Traits\Flushable;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use Flushable;
    
    protected $fillable = [ 'menu_id', 'title', 'url', 'order', 'custom' ];

    protected $casts = [
        'custom' => 'array',
    ];

    protected $appends = [ 'type' ];

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
