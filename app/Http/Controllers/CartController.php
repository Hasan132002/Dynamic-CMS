<?php

namespace App\Http\Controllers;

class CartController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.shop-pages.cart',
            'content/pages/shop-pages/cart.json'
        );
    }
}
