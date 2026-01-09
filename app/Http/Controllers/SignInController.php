<?php

namespace App\Http\Controllers;

class SignInController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.sign-in',
            'content/pages/inner-pages/sign-in.json'
        );
    }
}
