<?php

namespace App\Http\Controllers;

class BlogsController extends BasePageController
{
    public function blogs()
    {
        return $this->renderPage(
            'pages.blogs.blogs',
            'content/blogs/blogs.json'
        );
    }

    public function blogWithSidebar()
    {
        return $this->renderPage(
            'pages.blogs.blog-with-sidebar',
            'content/blogs/blog-sidebar.json'
        );
    }

    public function details()
    {
        return $this->renderPage(
            'pages.blogs.blog-details',
            'content/blogs/blog-details.json'
        );
    }
}
