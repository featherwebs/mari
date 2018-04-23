<?php

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\Setting;
use Featherwebs\Mari\Models\Page;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Http\UploadedFile;

if ( ! function_exists('fw_setting')) {
    function fw_setting($query)
    {
        $setting = Setting::fetch($query)->first();

        if ($setting) {
            if ($setting->images()->first()) {
                return asset($setting->images()->first()->url);
            }

            return $setting->value;
        } else {
            return null;
        }
    }
}
if ( ! function_exists('fw_image')) {
    function fw_image($limit = null)
    {
        $media = Image::query();

        if ($limit) {
            $media = $media->take($limit);
        }

        return $media->get();
    }
}
if ( ! function_exists('fw_menu')) {
    function fw_menu($slug)
    {
        return Menu::with('subMenus')->whereSlug($slug)->first();
    }
}
if ( ! function_exists('fw_posts_by_tag')) {
    function fw_posts_by_tag($tags, $limit = false, $builder = false)
    {
        $posts = Post::with('tags', 'images', 'custom', 'files')->published()->whereHas('tags', function ($q) use ($tags) {
            if (is_array($tags)) {
                $q->whereIn('slug', $tags);
            } else {
                $q->where('slug', strtolower($tags));
            }
        });

        if ($limit) {
            $posts = $posts->take($limit);
        }

        if ($builder) {
            return $posts;
        }

        return $posts->get();
    }
}
if ( ! function_exists('fw_posts_by_category')) {
    function fw_posts_by_category($category, $limit = false, $builder = false)
    {
        $posts = Post::with('tags', 'images', 'custom', 'files')
                     ->published()
                     ->whereHas('postType', function ($q) use ($category) {
                         if (is_array($category)) {
                             $q->whereIn('slug', $category);
                         } else {
                             $q->where('slug', $category);
                         }
                     });

        if ($limit) {
            $posts = $posts->take($limit);
        }

        if ($builder) {
            return $posts;
        }

        return $posts->get();
    }
}
if ( ! function_exists('fw_post_by_slug')) {
    function fw_post_by_slug($slug)
    {
        return Post::with('tags', 'images', 'custom', 'files')->published()->where('slug', $slug)->first();
    }
}
if ( ! function_exists('fw_post_by_id')) {
    function fw_post_by_id($id)
    {
        return Post::with('tags', 'images', 'custom', 'files')->published()->find($id);
    }
}
if ( ! function_exists('fw_posts')) {
    function fw_posts($limit = false, $builder = false)
    {
        $posts = Post::with('tags', 'images', 'custom', 'files')->published();
        if ($limit) {
            $posts = $posts->limit($limit);
        }

        if ($builder) {
            return $posts;
        }

        return $posts->get();
    }
}
if ( ! function_exists('fw_page_by_slug')) {
    function fw_page_by_slug($slug)
    {
        return Page::with('images')->where([ 'slug' => $slug ])->first();
    }
}
if ( ! function_exists('fw_pages')) {
    function fw_pages($limit = false)
    {
        $pages = Page::with('images')->published();
        if ($limit) {
            $pages = $pages->limit($limit);
        }

        return $pages->get();
    }
}
if ( ! function_exists('fw_upload_image')) {
    function fw_upload_image(UploadedFile $file, Model $model, $single = true, $slug = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = $file->getClientOriginalName();
        $image     = [
            'custom' => [ 'title' => $filename ],
            'path'   => $file->storeAs(strtolower(str_plural(class_basename($model))), str_random() . '.' . $extension, 'public')
        ];

        $imageInstance = Image::create($image);
        if ($single) {
            $model->images()->detach();
            $model->images()->save($imageInstance, [ 'slug' => str_slug($slug, '_') ]);
        } else {
            $model->images()->save($imageInstance, [ 'slug' => str_slug($slug, '_') ]);
        }
    }
}
if ( ! function_exists('fw_upload')) {
    function fw_upload(UploadedFile $file, Model $model, $single = true, $slug = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = $file->getClientOriginalName();
        $data      = [
            'name' => $filename,
            'size' => $file->getClientSize(),
            'path' => $file->storeAs(strtolower(str_plural(class_basename($model))), str_random() . '.' . $extension, 'uploads'),
            'slug' => $slug
        ];

        if ($single) {
            if ($model->files) {
                $model->files()->delete();
            }

            $model->files()->create($data);
        } else {
            $model->files()->create($data);
        }
    }
}
if ( ! function_exists('fw_fetch_data')) {
    function fw_fetch_data($url)
    {
        $client = new \GuzzleHttp\Client();
        $res    = $client->request('GET', $url);
        $data   = json_decode($res->getBody());

        return $data;

    }
}
if ( ! function_exists('fw_thumbnail')) {
    function fw_thumbnail($entity = null, $width = null, $height = null, $slug = "", $useDefault = true)
    {
        $text = empty($slug) ? env('APP_NAME') : $slug;
        if ($entity && $entity instanceof Image) {
            if ( ! $width && ! $height) {
                return $entity->url;
            }

            return $entity->getThumbnail($width, $height);
        } elseif ($entity && $entity->images && $entity->images->count()) {
            if (empty($slug)) {
                $image = $entity->images->first();
                if ( ! $width && ! $height) {
                    return $image->url;
                }

                return $image->getThumbnail($width, $height);
            } else {
                $image = $entity->images()->wherePivot('slug', $slug)->first();

                if ($image) {
                    if ( ! $width && ! $height) {
                        return $image->url;
                    }

                    return $image->getThumbnail($width, $height);
                }
            }
        } elseif ($entity && $entity->image && $entity instanceof Image) {
            $image = $entity->image;
            if ( ! $width && ! $height) {
                return $image->url;
            }

            return $image->getThumbnail($width, $height);
        }

        if ( ! $useDefault) {
            return false;
        }

        if ( ! $width && ! $height) {
            $width = 150;
        }
        if ($width && ! $height) {
            $height = $width;
        }
        $default = "http://via.placeholder.com/{$width}x{$height}?text=[" . $text . "]";

        return $default;
    }
}

if ( ! function_exists('fw_ordinal')) {
    /**
     * Append an ordinal indicator to a numeric value.
     * @param  string|int $value
     * @param  bool $superscript
     * @return string
     */
    function fw_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = [ 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' ];

        $suffix = $superscript ? '<sup>' . $indicators[ $number % 10 ] . '</sup>' : $indicators[ $number % 10 ];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }

        return number_format($number) . $suffix;
    }
}

if ( ! function_exists('fw_post_alias')) {
    function fw_post_alias($postType, $field, $default)
    {
        if ($postType instanceof PostType) {
            $aliases = collect($postType->alias);
            $alias   = $aliases->where('slug', $field)->first();
            if ($alias && array_key_exists('alias', $alias)) {
                return $alias['alias'];
            }
        }

        return $default;
    }
}

if ( ! function_exists('fw_post_alias_visible')) {
    function fw_post_alias_visible($postType, $field)
    {
        if ($postType instanceof PostType) {
            $aliases = collect($postType->alias);
            $alias   = $aliases->where('slug', $field)->first();
            if ($alias && array_key_exists('visible', $alias)) {
                return strtolower($alias['visible']) == "true";
            }
        }

        return true;
    }
}

if ( ! function_exists('fw_post_types')) {
    function fw_post_types($builder = false)
    {
        $postTypes = PostType::query();

        if ($builder) {
            return $postTypes;
        }

        return $postTypes->get();
    }
}

if ( ! function_exists('fw_post_type_by_slug')) {
    function fw_post_type_by_slug($slug = false)
    {
        $postType = PostType::where('slug', strtolower($slug))->first();

        return $postType;
    }
}

if ( ! function_exists('fw_get_videoid_from_url')) {
    function fw_get_videoid_from_url($url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        }
    }
}

if ( ! function_exists('fw_notifiables')) {
    /*
     * notifiables = admins + user defined emails in settings
     */
    function fw_notifiables($withCustomNotifiables = true)
    {
        $notifiables = collect([]);
        if ($withCustomNotifiables) {
            $notifiables = collect(explode(',', fw_setting('notification-emails')));
        }
        $admins = User::withRole('admin')->get();

        return $notifiables->map(function ($u) {
            return ( new User )->forceFill([
                'email' => $u,
            ]);
        })->merge($admins);

    }
}
if ( ! function_exists('fw_sync_images')) {
    /*
     *
     */
    function fw_sync_images($model, $images= [], $detach = true)
    {
        if(!is_array($images))
            throw new Exception('Expected array');

        if($detach)
            $model->images()->detach();

        foreach ($images as $k => $img) {

            if(!array_key_exists('path', $img))
                throw new Exception('Expected a key of `path`');

            $path = $img['path'];
            $slug = array_key_exists('slug', $img) ? $img['slug']: null;

            if ( ! empty($path)) {
                $filename = basename($path);
                $image = Image::where('path', 'like', '%'.$filename)->first();
                if($image)
                    $model->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
            }
        }

    }
}