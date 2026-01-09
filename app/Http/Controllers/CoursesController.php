<?php

namespace App\Http\Controllers;

class CoursesController extends BasePageController
{
    public function grid()
    {
        return $this->renderPage(
            'pages.courses.courses-grid-view',
            'content/courses/grid-view.json'
        );
    }

    public function gridWithSidebar()
    {
        return $this->renderPage(
            'pages.courses.courses-grid-with-sidebar',
            'content/courses/grid-with-sidebar.json'
        );
    }

    public function list()
    {
        return $this->renderPage(
            'pages.courses.courses-list-view',
            'content/courses/list.json'
        );
    }

    public function details()
    {
        return $this->renderPage(
            'pages.courses.course-details',
            'content/courses/detail-courses.json'
        );
    }
}
