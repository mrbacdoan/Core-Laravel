<?php

namespace App\Http\Controllers\Frontend;


use App\IZee\Heritages\Search as HeritageSearch;
use App\IZee\Locations\Search as LocationSearch;
use App\IZee\PhotoAlbums\Search as PhotoAlbumSearch;
use App\IZee\Sliders\Search as SliderSearch;
use Illuminate\Http\Request;


class HomeController extends FrontendController
{
    protected $request, $heritageSearch, $photoAlbumSearch, $locationSearch, $sliderSearch;

    public function __construct(Request $request, HeritageSearch $heritageSearch, PhotoAlbumSearch $photoAlbumSearch, LocationSearch $locationSearch, SliderSearch $sliderSearch)
    {
        $this->heritageSearch = $heritageSearch;
        $this->photoAlbumSearch = $photoAlbumSearch;
        $this->locationSearch = $locationSearch;
        $this->sliderSearch = $sliderSearch;
        $this->request = $request;
    }

    private function getMeta()
    {
        return ['title' => 'VICH.VN - Di Sản Văn Hóa Phi Vật Thể Việt Nam', 'description' => ''];
    }

    public function index()
    {
        $heritages = $this->heritageSearch->getAllHeritages();
        $photoAlbums = $this->photoAlbumSearch->getData();
        $areas = $this->locationSearch->getArea();
        $sliders = $this->sliderSearch->getSliders();
        $unescoHeritages = $this->heritageSearch->getAllHeritages(9, 1);
        $meta = $this->getMeta();
        return view('frontend.home.index', compact('photoAlbums', 'areas', 'sliders', 'heritages', 'unescoHeritages', 'meta'));
    }

}