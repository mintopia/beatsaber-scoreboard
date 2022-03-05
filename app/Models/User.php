<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static function getFromSteam(\Laravel\Socialite\Two\User $user)
    {
        $localUser = self::whereExternalId($user->id)->first();
        if (!$localUser) {
            $localUser = new User;
            $localUser->external_id = $user->id;
        }
        $localUser->email = $user->email;
        $localUser->avatar = $user->avatar;
        $localUser->nickname = $user->nickname;
        $localUser->save();
        return $localUser;
    }
}
