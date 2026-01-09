<?php

namespace App\Http\Controllers;

class UpcomingeEventController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.upcoming-events',
            'content/pages/inner-pages/upcoming-event.json'
        );
    }
}
