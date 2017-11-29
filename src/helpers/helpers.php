<?php

use Featherwebs\Mari\Models\Image;
use Featherwebs\Mari\Models\Menu;
use Featherwebs\Mari\Models\Post;
use Featherwebs\Mari\Models\Setting;

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

function fw_image($meta = null)
{
    $media = Image::query();

    if ($meta) {
        $media = $media->whereMeta($meta);
    }

    return $media->get();
}

function fw_menu($slug)
{
    return Menu::with('subMenus')->whereSlug($slug)->first();
}

function fw_post_by_tag($tag, $limit = false)
{
    $posts = Post::whereHas('tags', function ($q) use ($tag) {
        $q->where('slug', strtolower($tag));
    });

    if ($limit) {
        return $posts->take($limit);
    }

    return $posts->get();
}

function fw_post_by_category($category, $limit = false)
{
    $posts = Post::whereHas('postType', function ($q) use ($category) {
        $q->where('slug', $category);
    });

    if ($limit) {
        return $posts->take($limit);
    }

    return $posts->get();
}