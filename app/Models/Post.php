<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = ['title','content','image','category_id'];
    protected $appends = 'is_favourite';

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
