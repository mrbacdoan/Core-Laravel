<?php

namespace App\IZee\Categories;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'name', 'slug', 'priority', 'status', 'created_at', 'updated_at'];
}