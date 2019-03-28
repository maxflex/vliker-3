<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const SESSION_KEY = 'uid';

    public static function loggedIn()
    {
        return isset($_SESSION[self::SESSION_KEY]);
    }

    public static function createAndLogIn($params = [])
    {
        $user = self::create($params);
        $_SESSION[self::SESSION_KEY] = $user->id;
        setcookie(self::SESSION_KEY, $user->id, strtotime('+90 days'), '/');
        return $user;
    }

    public static function id()
    {
        return $_SESSION[self::SESSION_KEY];
    }

    public static function fromSession()
    {
        return self::find(self::id());
    }

    public static function tryCookieLogIn()
    {
        if (isset($_COOKIE[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = $_COOKIE[self::SESSION_KEY];
        }
    }
}
