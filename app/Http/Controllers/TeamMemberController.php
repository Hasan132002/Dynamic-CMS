<?php

namespace App\Http\Controllers;

class TeamMemberController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.menu-pages.inner-pages.team-member',
            'content/pages/inner-pages/team-member.json'
        );
    }
}
