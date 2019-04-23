<?php

use App\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Featherwebs\Mari\Models\File;
use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\PostType;
use Featherwebs\Mari\Models\Setting;
use Featherwebs\Mari\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

if ( ! function_exists('fw_setting')) {
    function fw_setting($query, $default = null)
    {
        $setting = Setting::fetch($query)->first();

        if ($setting && $setting->images()->first()) {
            return asset($setting->images()->first()->url);
        }

        if ( ! empty($setting->value)) {
            return $setting->value;
        }

        return $default;
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
        $posts = Post::with('tags', 'images', 'custom', 'files')
                     ->published()
                     ->latest()
                     ->whereHas('tags', function ($q) use ($tags) {
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
                     ->latest()
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
        return Post::with('tags', 'images', 'custom', 'files')->published()->latest()->where('slug', $slug)->first();
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
        $posts = Post::with('tags', 'images', 'custom', 'files')->latest()->published();
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
        $pages = Page::with('images')->published()->latest();
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
     *
     * @param string|int $value
     * @param bool $superscript
     * @return string
     */
    function fw_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = [ 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' ];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
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
        $postTypes = PostType::query()->latest();

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
            return (new User)->forceFill([
                'email' => $u,
            ]);
        })->merge($admins);

    }
}
if ( ! function_exists('fw_sync_images')) {
    /*
     *
     */
    function fw_sync_images($model, $images = [], $detach = true)
    {
        if ( ! is_array($images)) {
            throw new Exception('Expected array');
        }

        if ($detach) {
            $model->images()->detach();
        }

        foreach ($images as $k => $img) {

            if ( ! array_key_exists('path', $img)) {
                throw new Exception('Expected a key of `path`');
            }

            $path = $img['path'];
            $slug = array_key_exists('slug', $img) ? $img['slug'] : null;

            if ( ! empty($path)) {
                $filename = basename($path);
                $image    = Image::where('path', 'like', '%' . $filename)->first();
                if ($image) {
                    $model->images()->save($image, [ 'slug' => str_slug($slug, '_') ]);
                }
            }
        }

    }
}
if ( ! function_exists('fw_sync_files')) {
    /*
     *
     */
    function fw_sync_files($model, $files = [], $detach = true)
    {
        if ( ! is_array($files)) {
            throw new Exception('Expected array');
        }

        if ($detach) {
            $model->files()->detach();
        }

        foreach ($files as $k => $img) {
            if ( ! array_key_exists('path', $img)) {
                throw new Exception('Expected a key of `path`');
            }

            $path = $img['path'];
            $slug = array_key_exists('slug', $img) ? $img['slug'] : null;

            if ( ! empty($path)) {
                $filename = basename($path);
                $file     = File::where('path', 'like', '%' . $filename)->first();

                if ( ! $file) {
                    $file = Image::where('path', 'like', '%' . $filename)->first();
                }

                if ($file) {
                    $model->files()->save($file, [ 'slug' => str_slug($slug, '_') ]);
                }
            }
        }

    }
}

if ( ! function_exists('fw_tags')) {
    /*
     *
     */
    function fw_tags($builder = false)
    {
        $tags = Tag::query();
        if ($builder) {
            return $tags;
        }

        return $tags->get();
    }
}

if ( ! function_exists('fw_meta_title')) {
    /*
     *
     */
    function fw_meta_title($article, $default = null)
    {
        try {
            if ( ! empty($article->meta_title)) {
                return $article->meta_title;
            }
        } catch (Exception $e) {
        }
        try {
            if ( ! empty(fw_setting('meta_title'))) {
                return fw_setting('meta_title');
            }
        } catch (Exception $e) {
        }
        try {
            if ( ! empty($article->title)) {
                return $article->title;
            }
        } catch (Exception $e) {
        }
    }
}
if ( ! function_exists('fw_meta_desc')) {
    /*
     *
     */
    function fw_meta_desc($article, $default = null)
    {
        try {
            if ( ! empty($article->meta_description)) {
                return str_limit($article->meta_description, 200);
            }
        } catch (Exception $e) {
        }
        try {
            if ( ! empty($article->content)) {
                return str_limit(strip_tags($article->content), 200);
            }
        } catch (Exception $e) {
        }
        try {
            if ( ! empty(fw_setting('meta_description'))) {
                return str_limit(fw_setting('meta_description'), 200);
            }
        } catch (Exception $e) {
        }
    }
}
if ( ! function_exists('fw_meta_keywords')) {
    /*
     *
     */
    function fw_meta_keywords($article, $default = null)
    {
        try {
            if ( ! empty($article->meta_keywords)) {
                return $article->meta_keywords;
            }
        } catch (Exception $e) {
        }
        try {
            if ( ! empty(fw_setting('meta_keywords'))) {
                return fw_setting('meta_keywords');
            }
        } catch (Exception $e) {
        }
    }
}
if ( ! function_exists('fw_meta_image')) {
    /*
     *
     */
    function fw_meta_image($article, $default = null)
    {
        if ($article && $article->images()->count()) {
            return $article->images()->first()->url;
        }

        return fw_setting('logo', $default);
    }
}
if ( ! function_exists('fw_init_seo')) {
    /*
     *
     */
    function fw_init_seo($model = null)
    {
        if ($model instanceof Page) {
            $title       = current(array_filter([ $model->meta_title, $model->title, fw_setting('title') ]));
            $description = current(array_filter([
                $model->meta_description,
                str_limit(strip_tags($model->content), 200),
                fw_setting('description')
            ]));
            $images      = $model->images->push(fw_setting('logo'))->toArray();
            $keywords    = array_filter(array_merge(explode(',', $model->meta_keywords), explode(',', fw_setting('keywords'))));
        } else {
            if ($model instanceof Post) {
                $title       = current(array_filter([ $model->meta_title, $model->title, fw_setting('title') ]));
                $description = current(array_filter([
                    $model->meta_description,
                    str_limit(strip_tags($model->content), 200),
                    fw_setting('description')
                ]));
                $images      = $model->images->push(fw_setting('logo'))->toArray();
                $keywords    = array_filter(array_merge(explode(',', $model->meta_keywords), explode(',', fw_setting('keywords'))));
            } else {
                $title       = fw_setting('title');
                $description = fw_setting('description');
                $images      = [fw_setting('logo')];
                $keywords    = array_filter(explode(',', fw_setting('keywords')));
            }
        }

        SEOMeta::setTitleDefault(fw_setting('title'))
               ->setTitle($title, fw_setting('title') != $title)
               ->setDescription($description)
               ->addMeta('title', $title, 'property')
               ->addKeyword($keywords);

        SEOTools::setTitle($title, fw_setting('title') != $title)
                ->setDescription($description)
                ->addImages($images)
                ->setCanonical(request()->url());
        SEOTools::opengraph()
                ->setUrl(request()->url())
                ->setTitle($title, fw_setting('title') != $title)
                ->setDescription($description)
                ->addProperty('type', 'website')
                ->addProperty('locale', 'en_US')
                ->addProperty('site_name', fw_setting('title'));
        SEOTools::twitter()
                ->setTitle($title, fw_setting('title') != $title)
                ->setDescription($description)
                ->addValue('card', 'summary_large_image');
    }
}
