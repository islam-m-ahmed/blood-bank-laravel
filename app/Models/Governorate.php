<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
