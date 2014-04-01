<?php
class SpDispatcher
{
    public static function dispatch()
    {
        list($controlador, $action) = self::parseUri($_SERVER["REQUEST_URI"]);

        $controlador_class_name = Inflector::camelize($controlador) . 'Controlador';
        $action_name = substr_replace($action, "", strpos($action, "?"), strlen($action) - 1);

        $controlador_instance = new $controlador_class_name;
        $controlador_instance->controlador = $controlador;
        $controlador_instance->action = $action_name;
        $controlador_instance->{$action_name}();
    }

    private static function parseUri($uri)
    {
        // remove first slash
        $uri = substr_replace($uri, "", 0, 1);

        // remove index.php (if necessary)
        $uri = str_replace("index.php/", "", $uri);

        return explode("/", $uri, 2);
    }
}