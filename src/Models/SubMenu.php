<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $fillable = [ 'menu_id', 'title', 'url', 'custom', 'order' ];

    protected $casts = [
        'custom' => 'array'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
