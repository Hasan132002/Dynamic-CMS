<?php

namespace App\Http\Controllers;

class UpcomingEventController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.upcoming-events',
            'content/pages/inner-pages/upcoming-event.json'
        );
    }
}
