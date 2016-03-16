<?php

namespace App\IZee\Groups;


use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'groups';

    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'permissions', 'created_at'];
}