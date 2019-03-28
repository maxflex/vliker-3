<?php

namespace App\Utils;

class Url
{
    const REGEX = '/(photo|video|wall)[-]?[0-9]+[_][0-9]+([\?]reply=[0-9]+)?/';

    public static function shorten(string $url)
    {
        preg_match_all('/(photo|video|wall)[-]?[0-9]+[_][0-9]+([\?]reply=[0-9]+)?/', $url, $m);
        if (count($m[0])) {
            return $m[0][0];
        }
        return substr($url, strpos($url, 'vk.com') + 7);
    }

    public static function vk(string $url)
    {
        return 'https://vk.com/' . $url;
    }
}
