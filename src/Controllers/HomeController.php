<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
use Featherwebs\Mari\Models\PageType;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        fw_init_seo();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::find(fw_setting('homepage'));

        if ($page) {
            $page->load('images');
            $page->visit();

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
            if ( ! empty($page->view)) {
                $pageType = PageType::find($page->view);
                if($pageType && count($pageType->alias)) {
                    $pageTypeViewField = collect($pageType->alias)->firstWhere('slug','view');
                    if($pageTypeViewField) {
                        $view = $pageTypeViewField['default'];
                    }
                }

                if(view()->exists('pages.' . $page->view)) {
                    $view = $page->view;
                }
            }
        }

        $page->visit();
        fw_init_seo($page);

        return view('pages.' . $view, compact('page'));
    }
}
