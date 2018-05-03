<?php

namespace App\Listeners;

use Featherwebs\Mari\Models\File;
use Featherwebs\Mari\Models\Image;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File as FileSystem;
use Illuminate\Support\Facades\Log;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;

class ImageUploaded
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param ImageWasUploaded $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        $data = [
            'path' => str_replace(storage_path('app/public/'), "", $event->path())
        ];

        if(in_array(FileSystem::mimeType($event->path()), config('lfm.valid_image_mimetypes'))) {
            $image = Image::create($data);

            if ($image->file()->width() > 2048) {
                $image->file()->resize(2048, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($event->path());
            }

            if ($image->file()->height() > 2048) {
                $image->file()->resize(null, 2048, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($event->path());
            }
        } else {
            File::create($data);
        }
    }
}
