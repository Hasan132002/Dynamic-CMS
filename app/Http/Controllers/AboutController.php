<?php

namespace App\Http\Controllers;

class AboutController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.about',
            'content/about/about.json'
        );
    }
}
