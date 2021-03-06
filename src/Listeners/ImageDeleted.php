<?php

namespace Featherwebs\Mari\Listeners;

use Featherwebs\Mari\Models\Image;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use UniSharp\LaravelFilemanager\Events\ImageIsDeleting;
use UniSharp\LaravelFilemanager\Events\ImageWasDeleted;

class ImageDeleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param ImageWasDeleted $event
     * @return void
     */
    public function handle(ImageWasDeleted $event)
    {
        $path = str_replace(storage_path('app/public/'), "", $event->path());

        $image = Image::where('path', $path)->first();
        if($image)
            $image->delete();
    }
}
