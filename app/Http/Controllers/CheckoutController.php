<?php

namespace App\Http\Controllers;

class CheckoutController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.shop-pages.checkout',
            'content/pages/shop-pages/checkout.json'
        );
    }
}
