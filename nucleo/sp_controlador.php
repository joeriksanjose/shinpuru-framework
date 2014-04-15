<?php
class SpControlador
{
    const VIEW_FILE_EXT = '.php';

    public $controlador;
    public $action;
    public $output;
    public $params;

    /**
     * Renders the view file.
     * Returns the ouput if $return_output is set to true
     *
     * @param string $view
     * @param array $params
     * @param bool $return_output
     * @return string
     * @throws Exception
     */
    public function render($view = null, $params = array(), $return_output = false)
    {
        static $is_rendered = false;

        if ($is_rendered) {
            return;
        }

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
        $output = ob_get_clean();
        if ($return_output) {
            return $output;
        } else {
            $this->output = $output;
            $is_rendered = true;
        }
    }
}