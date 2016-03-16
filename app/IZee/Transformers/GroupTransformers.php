<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/12/2015
 * Time: 14:39 PM
 */

namespace App\IZee\Transformers;

use League\Fractal\TransformerAbstract;

class GroupTransformers extends TransformerAbstract
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
     * @param $resource
     * @return array
     */
    public function transform($resource)
    {
        return [
            'id' => $resource->id,
            'name'     => $resource->name,
            'permissions' => $resource->permissions,
            'members'  => $resource->users,
            'created_at' => $resource->created_at,
        ];
    }
}