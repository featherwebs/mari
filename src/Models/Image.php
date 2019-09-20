<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model
{
    const THUMB_PATH = 'thumbnails/';

    protected $guarded = [];

    protected $appends = [ 'thumbnail', 'url' ];

    protected $casts = [ 'custom' => 'array' ];

    public static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::flush();
        });
    }

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getThumbnailAttribute()
    {
        return $this->getThumbnail(150);
    }

    public function getThumbnail($width = null, $height = null)
    {
        if (($width == null && $height == null) || ! $this->file()) {
            return null;
        }

        $prefix           = 'TH_';
        $originalFilename = $filename = basename($this->path);
        $name             = $prefix . $width . '_' . $height . '_' . $originalFilename;
        $fileLocation     = self::THUMB_PATH . $name;
        if ( ! file_exists($fileLocation)) {
            $file = $this->file();
            if ($file->mime() == 'image/svg+xml') {
                $file->save($fileLocation);
            } elseif ($width == null || $height == null) {
                $file->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })
                     ->save($fileLocation);
            } else {
                $file->fit($width, $height)
                     ->save($fileLocation);
            }
        }

        return url($fileLocation);
    }

    public function file()
    {
        if (file_exists($this->getFullPath())) {
            return InterventionImage::make(storage_path('app/public/' . $this->path));
        }
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
