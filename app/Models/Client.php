<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'date_of_b', 'blood_type_id', 'city_id','last_donation_date','pin_code','status');


    public function bloodType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\BloodType', 'blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
    public function tokens(){
        return $this->hasMany(Token::class);
    }

    protected $hidden = [
        'password',
        'api_token',
    ];

}
