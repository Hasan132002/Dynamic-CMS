<?php

namespace App\Http\Controllers;

class SignUpController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.sign-up',
            'content/pages/inner-pages/signup.json'
        );
    }
}
