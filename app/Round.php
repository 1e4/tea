<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public $table = 'round';

    public function getUsersAttribute($value)
    {
        $users = [];
        $u = explode(',', $value);
        foreach($u as $user)
        {
            $users[$user] = Drinks::where('user', '=', $user)->first();
        }
        return $users;
    }

    public function drinks()
    {
        return $this->hasOne('\App\Drinks', 'user', 'user');
    }
}
