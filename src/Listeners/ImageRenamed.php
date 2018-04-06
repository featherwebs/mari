<?php

namespace App\Listeners;

use Featherwebs\Mari\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Unisharp\Laravelfilemanager\Events\ImageIsRenaming;

class ImageRenamed
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
     * @param  object $event
     * @return void
     */
    public function handle(ImageIsRenaming $event)
    {
        $oldPath = str_replace(storage_path('app/public/'), "", $event->oldPath());
        $newPath = str_replace(storage_path('app/public/'), "", $event->newPath());

        $image = Image::where('path', $oldPath)->first();

        if ($image) {
            $image->update([ 'path' => $newPath ]);
        }
    }
}