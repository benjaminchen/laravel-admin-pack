<?php

namespace BenjaminChen\Admin\Classes;

class Helper
{
    public static function arraySafeGet($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public static function validForUpdate($ruleArray, $keyName, $key)
    {
        foreach($ruleArray as $key => $rule) {
            if (strpos($rule, 'unique')) {
                $ruleArray[$key] = "{$rule},{$keyName},{$key}";
            }
        }
        return $ruleArray;
    }
}
