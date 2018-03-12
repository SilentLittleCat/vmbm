<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AD extends Model
{
    protected $table = 'ads';

    protected $guarded = [];

    public function tissue()
    {
        return $this->hasMany('App\Models\Tissue', 'ad_id');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client', 'a_d_clients', 'ad_id', 'client_id');
    }

    public function fans()
    {
        return $this->belongsToMany('App\Models\Fan', 'ad_fan', 'ad_id', 'fan_id');
    }
}
