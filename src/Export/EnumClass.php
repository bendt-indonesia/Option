<?php
/*
 *
  ____                 _ _     _____           _                       _
 |  _ \               | | |   |_   _|         | |                     (_)
 | |_) | ___ _ __   __| | |_    | |  _ __   __| | ___  _ __   ___  ___ _  __ _
 |  _ < / _ \ '_ \ / _` | __|   | | | '_ \ / _` |/ _ \| '_ \ / _ \/ __| |/ _` |
 | |_) |  __/ | | | (_| | |_   _| |_| | | | (_| | (_) | | | |  __/\__ \ | (_| |
 |____/ \___|_| |_|\__,_|\__| |_____|_| |_|\__,_|\___/|_| |_|\___||___/_|\__,_|

 Please don't modify this file because it may be overwritten when re-generated.
 */

namespace Bendt\Option\Enums;

abstract class EnumClass implements IEnum
{
    public static $STATUS_LIST = [];

    public static function ToKeyValue($keyName = 'key', $valueName  = 'value')
    {
        $key_value = [];
        foreach (static::$STATUS_LIST as $key => $value)
        {
            $key_value[] = [
                $keyName => $key,
                $valueName => $value
            ];
        }

        return $key_value;
    }

    public static function ToString($key)
    {
        if(array_key_exists($key, static::$STATUS_LIST))
        {
            return static::$STATUS_LIST[$key];
        }

        return null;
    }

    public static function ToArrayOfKey()
    {
        $array = [];
        foreach (static::$STATUS_LIST as $key => $value)
        {
            $array[] = $key;
        }

        return $array;
    }

    public static function ToRules()
    {
        $str = "";
        $n = 0;
        foreach (static::$STATUS_LIST as $key => $value)
        {
            if($n != 0) $str .= ",";
            $str .= $key;
            $n++;
        }

        return $str;
    }

}
