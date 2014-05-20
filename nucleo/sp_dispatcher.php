<?php
class SpDispatcher
{
    public static function dispatch()
    {
        list($controlador, $action_name) = self::parseUri($_SERVER["REQUEST_URI"]);

        $controlador_class_name = Inflector::camelize($controlador) . 'Controlador';

        $controlador_instance = new $controlador_class_name;
        $controlador_instance->controlador = $controlador;
        $controlador_instance->action = $action_name;
        $controlador_instance->{$action_name}();

        echo $controlador_instance->output;
    }

    /**
     * Sample URL : http://shinpuru.e/controller/action
     *
     * @param $uri
     * @return array
     * @throws SpException
     */
    private static function parseUri($uri)
    {
        if ($uri === "/") {
            // default action
            return array(DEFAULT_CONTROLADOR, DEFAULT_CONTROLADOR);
        }

        // remove first slash
        $uri = substr_replace($uri, "", 0, 1);

        // remove index.php (if necessary)
        $uri = str_replace("index.php/", "", $uri);

        $exploded_uri = explode("/", $uri);

        if (count($exploded_uri) > 2) {
            throw new SpException("Invalid URL format");
        }

        $action_name = $exploded_uri[1];
        $have_query_params = strpos($exploded_uri[1], "?");
        if ($have_query_params !== false) {
            // if there are query params
            $action_name = substr_replace($exploded_uri[1], "", $have_query_params, strlen($exploded_uri[1]) - 1);
        }

        return array($exploded_uri[0], $action_name);
    }
}