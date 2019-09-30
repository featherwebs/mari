<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [ 'path' ];

    protected $appends = [ 'url' ];

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
        static::deleted(function () {
            Cache::flush();
        });
    }

    public function fileable()
    {
        return $this->morphTo();
    }

    public function delete()
    {
        try {
            unlink($this->getFullPath());
        } catch (\Exception $e) {

        }

        parent::delete();
    }

    public function getFullPath()
    {
        return storage_path('app/public/' . $this->path);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
