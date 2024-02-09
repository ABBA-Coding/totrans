<?php


namespace App\Helpers;


class Helper
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function getLangId($lang = null)
    {
        if (empty($lang)) {
            $lang = 'ru';
        }
        return config('env.LOCALES')[$lang];
    }

    public static function getLangCode($langID)
    {
        $codes = config('env.LOCALES');
        return array_search($langID, $codes);
    }
}
