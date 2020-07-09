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
     *
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

if (!function_exists("check_last_active_topic_tab")) {
    /**
     * Generate color from giving string
     *
     * @param $isFirst
     * @param $topicID
     * @return string
     */
    function check_last_active_topic_tab($isFirst, $topicID)
    {
        if (!session()->has("lastTopic") && $isFirst)
            return true;
        else if (session()->has("lastTopic") && $topicID == session('lastTopic'))
            return true;
    }
}
if (!function_exists("placeholder_image")) {
    /**
     * Return placeholder image path
     *
     * @return string
     */
    function placeholder_image()
    {
        return asset("/media/placeholder.svg");
    }
}