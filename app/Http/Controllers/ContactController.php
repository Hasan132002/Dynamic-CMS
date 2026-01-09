<?php

namespace App\Http\Controllers;

class ContactController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.contact',
            'content/contact/contact.json'
        );
    }
}
