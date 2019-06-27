<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [ 'path' ];

    protected $appends = [ 'url' ];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function getFullPath()
    {
        return storage_path('app/public/' . $this->path);
    }

    public function delete()
    {
        try {
            unlink($this->getFullPath());
        } catch (\Exception $e) {

        }

        parent::delete();
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}
