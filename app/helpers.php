<?php


if (!function_exists("check_if_menu_is_active")) {
    /**
     * Check if current url equal to this menu item
     * @param string $url
     * @param string $prefix
     * @param string $class css class
     * @param string $reapWith prefix default wrap
     * @return string
     */
    function check_if_menu_is_active($url, $prefix = "", $class = "active", $reapWith = "admin/")
    {
        if ($prefix)
            $prefix = $prefix . "/";
        return request()->is("$reapWith$prefix$url", "$reapWith$prefix$url/*") ? $class : '';
    }
}

if (!function_exists("string_to_color")) {
    /**
     * Generate color from giving string
     * @param $string
     * @return string
     */
    function string_to_color($string)
    {
        $code = dechex(crc32($string));
        $code = substr($code, 0, 6);
        return '#' . $code;
    }
}