<?php

namespace App\Http\Controllers;

class ErrorController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.shop-pages.error',
            'content/pages/shop-pages/error.json'
        );
    }
}
