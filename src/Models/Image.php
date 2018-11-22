<?php

namespace Featherwebs\Mari\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model
{
    const THUMB_PATH = 'thumbnails/';

    protected $fillable = [ 'id', 'path', 'custom' ];

    protected $appends = [ 'thumbnail', 'url' ];

    protected $casts = [ 'custom' => 'array' ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getFullPath()
    {
        return storage_path('app/public/' . $this->path);
    }

    public function file()
    {
        if (file_exists($this->getFullPath())) {
            return InterventionImage::make(storage_path('app/public/' . $this->path));
        }
    }

    public function getThumbnail($width = null, $height = null)
    {
        if (($width == null && $height == null) || !$this->file()) {
            return null;
        }
        $prefix           = 'TH_';
        $originalFilename = $filename = basename($this->path);
        $name             = $prefix . $width . '_' . $height . '_' . $originalFilename;
        $fileLocation     = self::THUMB_PATH . $name;
        if ( ! file_exists($fileLocation)) {
            if ($width == null || $height == null) {
                $this->file()->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($fileLocation);
            } else {
                $this->file()->fit($width, $height)->save($fileLocation);
            }
        }

        return route('image.thumbs', $name);
    }

    public function getThumbnailAttribute()
    {
        return $this->getThumbnail(150);
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
