<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    protected $guarded = [];

    public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }

    public function ads()
    {
        return $this->belongsToMany('App\Models\AD', 'a_d_clients', 'client_id', 'ad_id');
    }
}
