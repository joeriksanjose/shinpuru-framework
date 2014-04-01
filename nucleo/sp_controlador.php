<?php
class SpControlador
{
    const VIEW_FILE_EXT = '.php';

    public $controlador;
    public $action;

    protected function render($view = null, $params = array())
    {
        $view_file = VISTA_DIR . $this->controlador . '/' . $this->action . self::VIEW_FILE_EXT;
        if ($view) {
            $view_file = VISTA_DIR . $view . self::VIEW_FILE_EXT;
        }

        if (!file_exists($view_file)) {
            throw new Exception("View file not found : {$view_file}");
        }

        extract($params);

        ob_start();
        ob_implicit_flush(0);
        include $view_file;
        echo ob_get_clean();
    }
}