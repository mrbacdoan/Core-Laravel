<?php

namespace App\IZee\Dashboards;

use App\IZee\Heritages\HeritageRepositoryInterface;
use App\IZee\PhotoAlbums\PhotoAlbumRepositoryInterface;
use App\IZee\Posts\PostRepositoryInterface;
use App\IZee\Videos\VideoRepositoryInterface;

class Dashboard
{

    protected $heritage, $post, $video, $photo;

    public function __construct(HeritageRepositoryInterface $heritage, PostRepositoryInterface $post,
                                VideoRepositoryInterface $video, PhotoAlbumRepositoryInterface $photo)
    {
        $this->heritage = $heritage;
        $this->post = $post;
        $this->video = $video;
        $this->photo = $photo;
    }

    public function data()
    {
        $lang = config('languages');
        $heritages = $posts = $medias = $photos = [];
        if(is_array($lang)){
            $var = ['heritage', 'post', 'video', 'photo'];
            foreach($var as $item){
                ${$item . 's'}['total'] = $this->{$item}->count(['column' => 'parent_id', 'value' => 0]);
            }
            foreach($lang as $key => $val){
                foreach($var as $item){
                    ${$item . 's'}['lang'][$val['code']] = $this->{$item}->count(['column' => 'lang', 'value' => $key]);
                }
            }
            $code = AJAX_SUCCESS;
        }
        return compact('code', 'heritages', 'posts', 'medias', 'photos');
    }
}