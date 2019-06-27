<?php

namespace Featherwebs\Mari\Controllers;

use Featherwebs\Mari\Models\Page;
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
        $page->visit();
        $view = 'default';
        if ( ! $page) {
            abort(404);
        } else {
            if ( ! empty($page->view) && view()->exists('pages.' . $page->view)) {
                $view = $page->view;
            }
        }

        fw_init_seo($page);

        return view('pages.' . $view, compact('page'));
    }
}
