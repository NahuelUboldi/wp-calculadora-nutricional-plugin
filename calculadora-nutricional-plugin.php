<?php
/**
 * Plugin name: WP Calculadora Nutricional 
 * Description: Permite obtener índice de masa corporal y otros parámetros a partir de datos ingresados por el usuario
 * Version: 1.1.0
 * Author: Nahuel Uboldi
 * Text Domain: calculadora-nutricional-plugin
 */

if (!defined('ABSPATH')) {
    die('You cannot be here');
}

if (!class_exists('CalculadoraNutricionalPlugin')) {

    class CalculadoraNutricionalPlugin
    {

        public function __construct()
        {

            define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));
            require_once MY_PLUGIN_PATH . 'vendor/autoload.php';

        }

        public function initialize()
        {

            include_once MY_PLUGIN_PATH . '/includes/utilities.php';  // Fixed the path
            include_once MY_PLUGIN_PATH . '/includes/options-page.php';  // Fixed the path
            include_once MY_PLUGIN_PATH . '/includes/main.php';  // Fixed the path
        }
    }

    $calculadoraNutricionalPlugin = new CalculadoraNutricionalPlugin;
    $calculadoraNutricionalPlugin->initialize();
}
