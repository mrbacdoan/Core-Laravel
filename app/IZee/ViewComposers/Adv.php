<?php


namespace App\IZee\ViewComposers;


use App\IZee\Advertisements\Search;
use Illuminate\Contracts\View\View;

class Adv
{

    private $adv;

    public function __construct(Search $search)
    {
        $this->adv = $search;
    }

    public function compose(View $view)
    {
        $view->with('adv', $this->adv->getAdvertisements());
    }

}