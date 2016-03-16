<?php

namespace App\IZee\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return [
            'id'         => $item->id,
            'full_name'  => $item->full_name,
            'username'   => $item->username,
            'email'      => $item->email,
            'phone'      => $item->phone,
            'status'     => $item->status,
            'group_name' => $item->group_name,
        ];
    }

}
