<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('city_id', 'blood_type_id', 'client_id','patient_phone','patient_age','patient_name',
        'bags_num','hospital_address');


    public function city()
{
        return $this->belongsTo('App\Models\City', 'city_id');
    }


    public function bloodType()
{
        return $this->belongsTo('App\Models\BloodType', 'blood_type_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}
