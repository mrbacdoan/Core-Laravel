<?php


namespace App\IZee\ViewComposers;


use App\IZee\Posts\PostRepositoryInterface;
use Illuminate\Contracts\View\View;

class PopularPost
{

    private $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function compose(View $view)
    {
        $view->with('popular_posts', $this->posts->getPopularPosts());
    }

}