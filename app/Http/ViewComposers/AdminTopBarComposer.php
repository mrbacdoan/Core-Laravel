<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class AdminTopBarComposer extends ViewComposer
{

    public function compose(View $view)
    {
        $view->with([
            '_notifications' => [
                'data'  => [
                    [
                        'class'       => 'fa fa-twitter fa-2x text-info',
                        'title'       => 'New followers',
                        'description' => '1 new follower',
                    ],
                    [
                        'class'       => 'fa fa-envelope fa-2x text-warning',
                        'title'       => 'New e-mails',
                        'description' => 'You have 10 new emails',
                    ],
                    [
                        'class'       => 'fa fa-tasks fa-2x text-success',
                        'title'       => 'Pending Tasks',
                        'description' => '11 pending task',
                    ],
                ],
                'new'   => 11,
                'total' => 14,
            ],
        ]);
    }
}