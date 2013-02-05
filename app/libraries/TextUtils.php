<?php

class TextUtils
{

    /**
     * Truncates string to the specified length.
     *
     * @param  string  $str       The string to be truncated
     * @param  integer $length    Max length of the string
     * @param  string  $ellipsis  The ellipsis
     * @return string             Original string or truncated string
     */
    public static function truncate($str, $length = 13, $ellipsis = '...')
    {
        if ($str == '') {
            return null;
        }

        if (strlen($str) > $length) {
            $truncated_str = substr($str, 0, $length - strlen($ellipsis));
            return $truncated_str . $ellipsis;
        } else {
            return $str;
        }
    }

}
