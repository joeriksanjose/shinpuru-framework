<?php
define('NUCLEO_DIR', ROOT_DIR.'nucleo/');
define('CONFIG_DIR', ROOT_DIR.'config/');
define('CONTROLADOR_DIR', ROOT_DIR.'controlador/');
define('MODELO_DIR', ROOT_DIR.'modelo/');
define('VISTA_DIR', ROOT_DIR.'vista/');
define('LIB_DIR', ROOT_DIR.'lib/');
define('TMP_DIR', ROOT_DIR.'tmp/');
define('LOG_DIR', TMP_DIR.'logs/');

// configs
require_once CONFIG_DIR . 'config.php';

// nucleo
require_once NUCLEO_DIR . 'sp_controlador.php';
require_once NUCLEO_DIR . 'sp_modelo.php';
require_once NUCLEO_DIR . 'sp_vista.php';
require_once NUCLEO_DIR . 'sp_dispatcher.php';
require_once NUCLEO_DIR . 'sp_exception.php';

// libraries
require_once LIB_DIR . 'inflector.php';

// autoloader function
spl_autoload_register(
    function ($class_name)
    {
        $filename = Inflector::underscore($class_name) . '.php';
        if (strpos($class_name, 'Controlador') !== false) {
            if (!file_exists(CONTROLADOR_DIR . $filename)) {
                throw new SpException("{$class_name} not found.");
            }

            require CONTROLADOR_DIR . $filename;
        } else {
            if (!file_exists(MODELO_DIR . $filename)) {
                throw new SpException("{$class_name} not found.");
            }

            require MODELO_DIR . $filename;
        }
    }
);