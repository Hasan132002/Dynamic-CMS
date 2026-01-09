<?php

namespace App\Http\Controllers;

class DepartmentController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.department',
            'content/pages/department.json'
        );
    }
}
