<?php

namespace App\Http\Controllers;

class TeamDetailsController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.team-details',
            'content/pages/inner-pages/team-details.json'
        );
    }
}
