<?php

namespace Featherwebs\Mari\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Featherwebs\Mari\Models\Page;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::find(fw_setting('homepage'))->load('images');

        if ($page) {
            return $this->page($page->slug);
        }

        return abort(404, 'Invalid View');
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->published()->first();

        $view = 'default';
        if ( ! $page) {
            abort(404);
        } else {
            if ( ! empty($page->view) && view()->exists('pages.' . $page->view)) {
                $view = $page->view;
            }
        }

        $title       = current(array_filter([ $page->meta_title, $page->title, fw_setting('title') ]));
        $description = current(array_filter([
            $page->meta_description,
            str_limit(strip_tags($page->content), 200),
            fw_setting('description')
        ]));
        $images      = $page->images->push(fw_setting('logo'))->toArray();
        $keywords    = array_filter(array_merge(explode(',', $page->meta_keywords), explode(',', fw_setting('keywords'))));

        SEOMeta::setTitleDefault(fw_setting('title'))
               ->setTitle($title)
               ->setDescription($description)
               ->addMeta('article:published_time', $page->updated_at->toW3CString(), 'property')
               ->addMeta('title', $title, 'property')
               ->addKeyword($keywords);

        SEOTools::setTitle($title)
                ->setDescription($description)
                ->addImages($images)
                ->setCanonical(request()->url());
        SEOTools::opengraph()
                ->setUrl(request()->url())
                ->setTitle($title)
                ->setDescription($description)
                ->addProperty('type', 'website')
                ->addProperty('locale', 'en_US')
                ->addProperty('site_name', fw_setting('title'));
        SEOTools::twitter()
                ->setTitle($title)
                ->setDescription($description)
                ->addValue('card', 'summary_large_image');

        return view('pages.' . $view, compact('page'));
    }
}
