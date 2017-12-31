<?php

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\Setting;
use Featherwebs\Mari\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

if ( ! function_exists('fw_setting')) {
    function fw_setting($query)
    {
        $setting = Setting::fetch($query)->first();

        if ($setting) {
            if ($setting->image) {
                return asset($setting->image->thumbnail);
            }

            return $setting->value;
        } else {
            return null;
        }
    }
}
if ( ! function_exists('fw_image')) {
    function fw_image($meta = null, $limit = null)
    {
        $media = Image::query();

        if ($meta) {
            $media = $media->whereMeta($meta);
        }

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
        $posts = Post::with('tags')->published()->whereHas('tags', function ($q) use ($tags) {
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
        $posts = Post::with('tags')->published()->whereHas('postType', function ($q) use ($category) {
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
        return Post::with('tags')->published()->where('slug', $slug)->first();
    }
}
if ( ! function_exists('fw_posts')) {
    function fw_posts($limit = false, $builder = false)
    {
        $posts = Post::published();
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
        return Page::where([ 'slug' => $slug ])->first();
    }
}
if ( ! function_exists('fw_pages')) {
    function fw_pages($limit = false)
    {
        $pages = Page::published();
        if ($limit) {
            $pages = $pages->limit($limit);
        }

        return $pages->get();
    }
}
if ( ! function_exists('fw_upload_image')) {
    function fw_upload_image(UploadedFile $file, Model $model, $single = true, $meta = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = $file->getClientOriginalName();
        $image     = [
            'custom' => [ 'title' => $filename ],
            'path'   => $file->storeAs(strtolower(str_plural(class_basename($model))), str_random() . '.' . $extension, 'public'),
            'meta'   => str_slug($meta, '_'),
        ];

        if ($single) {
            if ($model->image) {
                $model->image->delete();
            }

            $model->image()->create($image);
        } else {
            $model->images()->create($image);
        }
    }
}
if ( ! function_exists('fw_upload')) {
    function fw_upload(UploadedFile $file, Model $model, $single = true)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = $file->getClientOriginalName();
        $data      = [
            'filename' => $filename,
            'path'     => $file->storeAs(strtolower(str_plural(class_basename($model))), str_random() . '.' . $extension, 'public')
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
    function fw_thumbnail($entity = null, $width = 150, $height = 150, $slug = "")
    {
        $text    = empty($slug) ? env('APP_NAME') : $slug;
        $default = "http://via.placeholder.com/{$width}x{$height}?text=[" . $text . "]";
        if ($entity && $entity instanceof Image) {
            return $entity->getThumbnail($width, $height);
        } elseif ($entity && $entity->images && $entity->images->count()) {
            if (empty($slug)) {
                return $entity->images->first()->getThumbnail($width, $height);
            } else {
                $image = $entity->images()->where('meta', $slug)->first();
                if ($image) {
                    return $image->getThumbnail($width, $height);
                }
            }
        } elseif ($entity && $entity->image) {
            return $entity->image->getThumbnail($width, $height);
        }

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