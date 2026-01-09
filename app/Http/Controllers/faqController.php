<?php

namespace App\Http\Controllers;

class FaqController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.shop-pages.faqs',
            'content/pages/shop-pages/faqs.json'
        );
    }
}
