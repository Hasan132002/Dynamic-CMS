<?php

namespace App\Http\Controllers;

class InstructorRegistrationController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.instructor-registrations',
            'content/pages/inner-pages/instructor-reg.json'
        );
    }
}
