<?php

namespace App\IZee\ViewComposers;


use App\IZee\Heritages\HeritageRepositoryInterface;
use Illuminate\Contracts\View\View;

class PopularHeritage
{

    private $heritage;

    public function __construct(HeritageRepositoryInterface $heritage)
    {
        $this->heritage = $heritage;
    }

    public function compose(View $view)
    {
        $view->with('popular_heritages', $this->heritage->getPopularHeritages());
    }

}