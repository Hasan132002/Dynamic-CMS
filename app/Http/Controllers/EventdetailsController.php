<?php

namespace App\Http\Controllers;

class EventdetailsController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.event-details',
            'content/pages/inner-pages/event-details.json'
        );
    }
}
