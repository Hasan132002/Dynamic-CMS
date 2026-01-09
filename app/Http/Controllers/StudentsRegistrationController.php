<?php

namespace App\Http\Controllers;

class StudentsRegistrationController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.student-registrations',
            'content/pages/inner-pages/students-reg.json'
        );
    }
}
