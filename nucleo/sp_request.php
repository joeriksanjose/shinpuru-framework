<?php
class SpRequest
{
    public static function get($key, $default_value = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default_value;
    }

    public static function post($key, $default_value = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default_value;
    }

    public static function isMethodGet()
    {
        return ($_SERVER["REQUEST_METHOD"] === "GET");
    }

    public static function isMethodPost()
    {
        return ($_SERVER["REQUEST_METHOD"] === "POST");
    }
}