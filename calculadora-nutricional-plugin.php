<?php
/**
 * 
 * Plugin name: WP Calculadora Nutricional 
 * Description: Custom Plugin de calculadora nutricional que permite obtener índice de masa corporal y otros parámetros
 * Version: 1.0.0
 * Author: Nahuel Uboldi
 * Text Domain: contact-plugin
 * 
 */

if( !defined('ABSPATH') )
{
      die('You cannot be here');
}

if( !class_exists('CalculadoraNutricionalPlugin') )
{



            class CalculadoraNutricionalPlugin{


                  public function __construct()
                  {

                        define('MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

                        define('MY_PLUGIN_URL', plugin_dir_url( __FILE__ ));

                        require_once(MY_PLUGIN_PATH . '/vendor/autoload.php');

                  }

                  public function initialize()
                  {
                        include_once MY_PLUGIN_PATH . 'includes/utilities.php';

                        include_once MY_PLUGIN_PATH . 'includes/options-page.php';

                        include_once MY_PLUGIN_PATH . 'includes/main.php';
                  }


            }

            $calculadoraNutricionalPlugin = new CalculadoraNutricionalPlugin;
            $calculadoraNutricionalPlugin->initialize();

}